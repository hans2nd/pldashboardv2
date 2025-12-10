<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm text-white">
                            <i class="fa fa-plus"></i> Add Roles
                        </a>
                    </div>

                    {{-- <form method="GET" action="{{ route('users.index') }}"
                        class="d-flex align-items-center gap-2 flex-wrap">
                        <select name="role" class="form-control form-select form-select-sm" style="max-width: 200px;"
                            onchange="this.form.submit()">
                            <option value="">-- Semua Role --</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="sales" {{ request('role') == 'sales' ? 'selected' : '' }}>Sales</option>
                            <option value="logistic" {{ request('role') == 'logistic' ? 'selected' : '' }}>Logistic
                            </option>
                        </select>

                        <x-search-bar :action="route('users.index')" placeholder="Cari nama atau email..." />
                    </form> --}}
                </div>

                {{-- @if (request('search'))
                    <div class="alert alert-info py-2">
                        Menampilkan hasil untuk pencarian: <strong>{{ request('search') }}</strong>
                        ({{ $users->total() }} hasil)
                    </div>
                @endif --}}

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <x-table-header label="#" field="id" sortable="false" />
                                    <x-table-header label="Name" field="name" sortable="true" />
                                    <x-table-header label="Permission" field="username" sortable="true" />
                                    <x-table-header label="Action" field="action" sortable="false" />
                                </tr>
                            </thead>
                            <tbody>
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}
                                            </td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                            <td>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                        class="btn btn-warning btn-sm text-blue-600 hover:underline"><i
                                                            class="fa fa-edit"></i> Edit</a>
                                                    <button type="submit" class="btn btn-danger btn-sm btn-delete"
                                                        data-fullname="{{ $role->name }}">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="mt-4">{{ $users->links() }}</div> --}}
                </div>
            </div>
        </div>
    </div>
</x-layout>
