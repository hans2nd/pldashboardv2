<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Menu: {{ $menuItem->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('menus.update', $menuItem) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $menuItem->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="key" class="form-label">Key <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('key') is-invalid @enderror" 
                                           id="key" name="key" value="{{ old('key', $menuItem->key) }}" required>
                                    @error('key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Key digunakan untuk permission: <code>{{ $menuItem->key }} view</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon (FontAwesome)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="{{ $menuItem->icon ?? 'fas fa-folder' }}"></i></span>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                               id="icon" name="icon" value="{{ old('icon', $menuItem->icon) }}" 
                                               placeholder="fas fa-tachometer-alt">
                                    </div>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe Menu <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="dashboard" {{ old('type', $menuItem->type) == 'dashboard' ? 'selected' : '' }}>Dashboard (iframe)</option>
                                        <option value="link" {{ old('type', $menuItem->type) == 'link' ? 'selected' : '' }}>Link (internal route)</option>
                                        <option value="header" {{ old('type', $menuItem->type) == 'header' ? 'selected' : '' }}>Header (parent only)</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent Menu</label>
                                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                        <option value="">-- No Parent (Root) --</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id', $menuItem->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Urutan</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order', $menuItem->order) }}" min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="route" class="form-label">Route Name</label>
                            <input type="text" class="form-control @error('route') is-invalid @enderror" 
                                   id="route" name="route" value="{{ old('route', $menuItem->route) }}" 
                                   placeholder="dashboard.menu_name">
                            @error('route')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika menu adalah parent/header</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $menuItem->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Aktif</label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Menu
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
                    <h4 class="card-title">Info Menu</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID</strong></td>
                            <td>{{ $menuItem->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Permission</strong></td>
                            <td>
                                @php
                                    $linkedPermission = $menuItem->getLinkedPermission();
                                @endphp
                                @if($linkedPermission)
                                    <a href="{{ route('permissions.edit', $linkedPermission->id) }}" class="badge bg-success text-decoration-none">
                                        <i class="fas fa-key me-1"></i>{{ $menuItem->permission_name }}
                                    </a>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-key me-1"></i>{{ $menuItem->permission_name }}
                                    </span>
                                    <small class="text-muted d-block mt-1">
                                        <i class="fas fa-info-circle"></i> Permission belum dibuat
                                    </small>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Created</strong></td>
                            <td>{{ $menuItem->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated</strong></td>
                            <td>{{ $menuItem->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Child Menus Management Card --}}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sitemap"></i> Child Menus 
                        <span class="badge bg-primary" id="childCount">{{ $menuItem->children->count() }}</span>
                    </h5>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addChildModal">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0" id="childMenuTable">
                            <tbody>
                                @forelse($menuItem->children as $child)
                                    <tr id="child-row-{{ $child->id }}">
                                        <td class="ps-3">
                                            <i class="{{ $child->icon ?? 'fas fa-file' }} text-muted me-2"></i>
                                            {{ $child->name }}
                                        </td>
                                        <td class="text-center" style="width: 60px;">
                                            @if($child->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Inaktif</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3" style="width: 80px;">
                                            <a href="{{ route('menus.edit', $child) }}" class="btn btn-warning btn-sm py-0 px-1" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm py-0 px-1 btn-delete-child" 
                                                    data-url="{{ route('menus.children.destroy', [$menuItem, $child]) }}"
                                                    data-name="{{ $child->name }}" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="no-children-row">
                                        <td colspan="3" class="text-center text-muted py-3">
                                            <i class="fas fa-inbox"></i> Belum ada child menu
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add Child Menu --}}
    <div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addChildModalLabel">
                        <i class="fas fa-plus-circle"></i> Tambah Child Menu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addChildForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="child_name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="child_name" name="name" required>
                            <div class="invalid-feedback" id="error_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="child_icon" class="form-label">Icon</label>
                                    <input type="text" class="form-control" id="child_icon" name="icon" 
                                           value="fas fa-chart-line" placeholder="fas fa-chart-line">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="child_type" class="form-label">Tipe <span class="text-danger">*</span></label>
                                    <select class="form-select" id="child_type" name="type" required>
                                        <option value="dashboard">Dashboard (iframe)</option>
                                        <option value="link">Link (internal route)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="child_route" class="form-label">Route Name</label>
                                    <input type="text" class="form-control" id="child_route" name="route" 
                                           placeholder="dashboard.menu_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="child_order" class="form-label">Urutan</label>
                                    <input type="number" class="form-control" id="child_order" name="order" value="0" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="child_is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="child_is_active">Aktif</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="child_auto_permission" name="auto_permission" value="1" checked>
                                    <label class="form-check-label" for="child_auto_permission">Auto Permission</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitChild">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addChildForm = document.getElementById('addChildForm');
        const addChildModal = new bootstrap.Modal(document.getElementById('addChildModal'));
        const childMenuTable = document.getElementById('childMenuTable').querySelector('tbody');
        const childCount = document.getElementById('childCount');
        const storeUrl = "{{ route('menus.children.store', $menuItem) }}";

        // Add Child Form Submit
        addChildForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btnSubmit = document.getElementById('btnSubmitChild');
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

            // Clear previous errors
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            const formData = new FormData(addChildForm);
            
            fetch(storeUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove "no children" row if exists
                    const noChildrenRow = document.getElementById('no-children-row');
                    if (noChildrenRow) noChildrenRow.remove();

                    // Add new row to table
                    const newRow = createChildRow(data.data);
                    childMenuTable.appendChild(newRow);

                    // Update count
                    childCount.textContent = parseInt(childCount.textContent) + 1;

                    // Reset form and close modal
                    addChildForm.reset();
                    document.getElementById('child_icon').value = 'fas fa-chart-line';
                    document.getElementById('child_is_active').checked = true;
                    document.getElementById('child_auto_permission').checked = true;
                    addChildModal.hide();

                    // Show success message
                    showAlert('success', data.message);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const input = document.querySelector(`[name="${key}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const feedback = document.getElementById(`error_${key}`);
                                if (feedback) feedback.textContent = data.errors[key][0];
                            }
                        });
                    }
                    showAlert('danger', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'Terjadi kesalahan saat menyimpan');
            })
            .finally(() => {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="fa fa-save"></i> Simpan';
            });
        });

        // Delete Child Button Handler
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-delete-child')) {
                const btn = e.target.closest('.btn-delete-child');
                const url = btn.dataset.url;
                const name = btn.dataset.name;

                if (confirm(`Apakah Anda yakin ingin menghapus child menu "${name}"?`)) {
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove row from table
                            const row = btn.closest('tr');
                            row.remove();

                            // Update count
                            const newCount = parseInt(childCount.textContent) - 1;
                            childCount.textContent = newCount;

                            // Show "no children" row if empty
                            if (newCount === 0) {
                                childMenuTable.innerHTML = `
                                    <tr id="no-children-row">
                                        <td colspan="3" class="text-center text-muted py-3">
                                            <i class="fas fa-inbox"></i> Belum ada child menu
                                        </td>
                                    </tr>
                                `;
                            }

                            showAlert('success', data.message);
                        } else {
                            showAlert('danger', data.message);
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fa fa-trash"></i>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('danger', 'Terjadi kesalahan saat menghapus');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa fa-trash"></i>';
                    });
                }
            }
        });

        function createChildRow(data) {
            const tr = document.createElement('tr');
            tr.id = `child-row-${data.id}`;
            tr.innerHTML = `
                <td class="ps-3">
                    <i class="${data.icon} text-muted me-2"></i>
                    ${data.name}
                </td>
                <td class="text-center" style="width: 60px;">
                    ${data.is_active 
                        ? '<span class="badge bg-success">Aktif</span>' 
                        : '<span class="badge bg-secondary">Inaktif</span>'}
                </td>
                <td class="text-end pe-3" style="width: 80px;">
                    <a href="${data.edit_url}" class="btn btn-warning btn-sm py-0 px-1" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm py-0 px-1 btn-delete-child" 
                            data-url="${data.delete_url}"
                            data-name="${data.name}" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `;
            return tr;
        }

        function showAlert(type, message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 400px;';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alertDiv);
            
            setTimeout(() => alertDiv.remove(), 5000);
        }
    });
    </script>
    @endpush
</x-layout>

