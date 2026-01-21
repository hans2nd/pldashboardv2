<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Menu</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon (FontAwesome)</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" name="icon" value="{{ old('icon', 'fas fa-tachometer-alt') }}" 
                                           placeholder="fas fa-tachometer-alt">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Contoh: fas fa-chart-line, fas fa-cogs</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe Menu <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="dashboard" {{ old('type') == 'dashboard' ? 'selected' : '' }}>Dashboard (iframe)</option>
                                        <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Link (internal route)</option>
                                        <option value="header" {{ old('type') == 'header' ? 'selected' : '' }}>Header (parent only)</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent Menu</label>
                                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                        <option value="">-- No Parent (Root) --</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="route" class="form-label">Route Name</label>
                                    <input type="text" class="form-control @error('route') is-invalid @enderror" 
                                           id="route" name="route" value="{{ old('route') }}" 
                                           placeholder="dashboard.menu_name">
                                    @error('route')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Kosongkan jika menu adalah parent/header</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Urutan</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order', 0) }}" min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="auto_permission" name="auto_permission" value="1" 
                                               {{ old('auto_permission', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="auto_permission">Auto Generate Permission</label>
                                    </div>
                                    <small class="text-muted">Permission akan otomatis dibuat berdasarkan nama menu</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Simpan Menu
                            </button>
                            <a href="{{ route('menus.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Panduan</h4>
                </div>
                <div class="card-body">
                    <h6><i class="fas fa-info-circle text-primary"></i> Tipe Menu</h6>
                    <ul class="small">
                        <li><strong>Dashboard:</strong> Menu dengan iframe Power BI</li>
                        <li><strong>Link:</strong> Menu dengan internal route</li>
                        <li><strong>Header:</strong> Menu parent tanpa link</li>
                    </ul>
                    
                    <h6 class="mt-3"><i class="fas fa-key text-warning"></i> Auto Permission</h6>
                    <p class="small">Jika dicentang, permission <code>{key} view</code> akan otomatis dibuat.</p>
                    
                    <h6 class="mt-3"><i class="fas fa-route text-success"></i> Route Name</h6>
                    <p class="small">Format: <code>dashboard.nama_menu</code>. Harus didaftarkan di routes/web.php</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
