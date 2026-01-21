<?php

/**
 * SQLite to MySQL Migration Script
 * 
 * Langkah penggunaan:
 * 1. Pastikan MySQL sudah running dan database sudah dibuat
 * 2. Update .env dengan kredensial MySQL
 * 3. Jalankan: php artisan migrate (untuk membuat struktur tabel di MySQL)
 * 4. Jalankan: php artisan sqlite:migrate-to-mysql
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateSqliteToMysql extends Command
{
    protected $signature = 'sqlite:migrate-to-mysql';
    protected $description = 'Migrate data from SQLite to MySQL';

    public function handle()
    {
        $this->info('Starting SQLite to MySQL migration...');

        // Set SQLite connection
        config(['database.connections.sqlite_source' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
        ]]);

        // Tables to migrate (in order to respect foreign keys)
        $tables = [
            'users',
            'roles',
            'permissions',
            'role_has_permissions',
            'model_has_roles',
            'model_has_permissions',
            'dashboard_settings',
            'dashboard_menus',
            'sessions',
            'cache',
            'jobs',
        ];

        foreach ($tables as $table) {
            $this->migrateTable($table);
        }

        $this->info('Migration completed successfully!');
        return 0;
    }

    private function migrateTable(string $table)
    {
        // Check if table exists in SQLite
        if (!Schema::connection('sqlite_source')->hasTable($table)) {
            $this->warn("Table '$table' does not exist in SQLite, skipping...");
            return;
        }

        // Check if table exists in MySQL
        if (!Schema::hasTable($table)) {
            $this->warn("Table '$table' does not exist in MySQL, skipping...");
            return;
        }

        $this->info("Migrating table: $table");

        try {
            // Get all data from SQLite
            $data = DB::connection('sqlite_source')->table($table)->get();

            if ($data->isEmpty()) {
                $this->line("  - No data to migrate");
                return;
            }

            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Truncate MySQL table (optional - remove if you want to append)
            // DB::table($table)->truncate();

            // Insert data in chunks
            $chunks = $data->chunk(100);
            $totalRows = 0;

            foreach ($chunks as $chunk) {
                $insertData = $chunk->map(function ($item) {
                    return (array) $item;
                })->toArray();

                DB::table($table)->insert($insertData);
                $totalRows += count($insertData);
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            $this->line("  - Migrated $totalRows rows");

        } catch (\Exception $e) {
            $this->error("  - Error: " . $e->getMessage());
        }
    }
}
