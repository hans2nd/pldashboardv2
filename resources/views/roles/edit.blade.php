<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Edit Role: {{ $role->name }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Role Name --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Role Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Enter role name" 
                                value="{{ old('name', $role->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Search Permissions --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Permissions</label>
                            <input type="text" id="searchPermission" class="form-control form-control-sm mb-3" 
                                   placeholder="Search permissions..." style="max-width: 300px;">
                            
                            <div class="mb-2">
                                <button type="button" class="btn btn-sm btn-outline-primary me-2" id="selectAll">
                                    <i class="fa fa-check-square"></i> Select All
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAll">
                                    <i class="fa fa-square"></i> Deselect All
                                </button>
                                <span class="ms-3 text-muted"><span id="selectedCount">0</span> selected</span>
                            </div>
                        </div>

                        {{-- Permissions Grid --}}
                        @php
                            $currentPermissions = old('permission', $rolePermissions->toArray());
                        @endphp
                        <div class="row g-2" id="permissionsContainer">
                            @foreach ($permissions as $permission)
                                @php
                                    $isChecked = in_array($permission->name, $currentPermissions);
                                @endphp
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 permission-item" data-name="{{ strtolower($permission->name) }}">
                                    <label class="permission-card d-block p-2 border rounded text-center cursor-pointer {{ $isChecked ? 'selected' : '' }}">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}" 
                                               class="permission-checkbox d-none"
                                               {{ $isChecked ? 'checked' : '' }}>
                                        <span class="permission-name small">{{ $permission->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a href="{{ route('roles.index') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .permission-card {
            cursor: pointer;
            transition: all 0.2s ease;
            background: #f8f9fa;
            border: 1px solid #dee2e6 !important;
            min-height: 50px;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
        .permission-card:hover {
            background: #e9ecef;
            border-color: #6777ef !important;
        }
        .permission-card.selected {
            background: #6777ef;
            border-color: #6777ef !important;
            color: white;
        }
        .permission-card.selected .permission-name {
            color: white;
        }
        .permission-name {
            word-break: break-word;
            font-size: 0.75rem;
            line-height: 1.2;
        }
        .permission-item.hidden {
            display: none !important;
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchPermission');
            const permissionItems = document.querySelectorAll('.permission-item');
            const permissionCards = document.querySelectorAll('.permission-card');
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const selectAllBtn = document.getElementById('selectAll');
            const deselectAllBtn = document.getElementById('deselectAll');
            const selectedCount = document.getElementById('selectedCount');

            function updateCount() {
                const checked = document.querySelectorAll('.permission-checkbox:checked').length;
                selectedCount.textContent = checked;
            }

            // Toggle card selection
            permissionCards.forEach(card => {
                card.addEventListener('click', function() {
                    const checkbox = this.querySelector('.permission-checkbox');
                    checkbox.checked = !checkbox.checked;
                    this.classList.toggle('selected', checkbox.checked);
                    updateCount();
                });
            });

            // Search functionality
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                permissionItems.forEach(item => {
                    const name = item.dataset.name;
                    if (name.includes(searchTerm)) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });

            // Select All (visible only)
            selectAllBtn.addEventListener('click', function() {
                permissionItems.forEach(item => {
                    if (!item.classList.contains('hidden')) {
                        const checkbox = item.querySelector('.permission-checkbox');
                        const card = item.querySelector('.permission-card');
                        checkbox.checked = true;
                        card.classList.add('selected');
                    }
                });
                updateCount();
            });

            // Deselect All
            deselectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    checkbox.closest('.permission-card').classList.remove('selected');
                });
                updateCount();
            });

            updateCount();
        });
    </script>
    @endpush
</x-layout>
