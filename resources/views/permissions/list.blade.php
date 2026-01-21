<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm text-white">
                            <i class="fa fa-plus"></i> Add Permission
                        </a>
                        
                        {{-- Bulk Actions --}}
                        <div class="bulk-actions d-none" id="bulkActions">
                            <span class="me-2 text-muted"><span id="selectedCount">0</span> selected</span>
                            <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn">
                                <i class="fa fa-trash"></i> Delete Selected
                            </button>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <form method="GET" action="{{ route('permissions.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" name="search" class="form-control form-control-sm" 
                                   placeholder="Search permissions..." value="{{ request('search') }}">
                            <button class="btn btn-primary btn-sm" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                @if (request('search'))
                    <div class="alert alert-info py-2 mx-3">
                        Menampilkan hasil untuk: <strong>{{ request('search') }}</strong>
                        ({{ $permissions->total() }} hasil)
                    </div>
                @endif

                <div class="card-body table-border-style">
                    <form id="bulkForm" action="{{ route('permissions.bulk-delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:3%;">
                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                        </th>
                                        <th style="width:5%;">#</th>
                                        <th>Name</th>
                                        <th style="width:15%;">Guard</th>
                                        <th style="width:15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="ids[]" value="{{ $permission->id }}" 
                                                       class="form-check-input row-checkbox">
                                            </td>
                                            <td>{{ $loop->iteration + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $permission->name }}</span>
                                            </td>
                                            <td>{{ $permission->guard_name }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $permission->id) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" 
                                                            data-fullname="{{ $permission->name }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">No permissions found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                    
                    <div class="mt-4">{{ $permissions->appends(request()->query())->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkForm = document.getElementById('bulkForm');

            function updateBulkActions() {
                const checked = document.querySelectorAll('.row-checkbox:checked');
                selectedCount.textContent = checked.length;
                bulkActions.classList.toggle('d-none', checked.length === 0);
            }

            selectAll.addEventListener('change', function() {
                rowCheckboxes.forEach(cb => cb.checked = this.checked);
                updateBulkActions();
            });

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateBulkActions);
            });

            bulkDeleteBtn.addEventListener('click', function() {
                const checked = document.querySelectorAll('.row-checkbox:checked');
                if (checked.length === 0) return;
                
                Swal.fire({
                    title: 'Delete ' + checked.length + ' permissions?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        bulkForm.submit();
                    }
                });
            });
        });
    </script>
    @endpush
</x-layout>
