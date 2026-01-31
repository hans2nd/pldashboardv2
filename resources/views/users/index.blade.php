<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm text-white">
                            <i class="fa fa-plus"></i> Add User
                        </a>
                        
                        {{-- Bulk Actions --}}
                        <div class="bulk-actions d-none" id="bulkActions">
                            <span class="me-2 text-muted"><span id="selectedCount">0</span> selected</span>
                            <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn">
                                <i class="fa fa-trash"></i> Delete Selected
                            </button>
                        </div>
                    </div>

                    {{-- Filter and Search --}}
                    <form method="GET" action="{{ route('users.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
                        <select name="role" class="form-control form-select form-select-sm" style="max-width: 150px;"
                            onchange="this.form.submit()">
                            <option value="">-- All Roles --</option>
                            @foreach (\Spatie\Permission\Models\Role::all()->sortBy('name') as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>

                        <div class="input-group" style="max-width: 250px;">
                            <input type="text" name="search" class="form-control form-control-sm" 
                                   placeholder="Search name/email..." value="{{ request('search') }}">
                            <button class="btn btn-primary btn-sm" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            @if(request('search') || request('role'))
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                @if (request('search') || request('role'))
                    <div class="alert alert-info py-2 mx-3">
                        @if(request('search'))
                            Search: <strong>{{ request('search') }}</strong>
                        @endif
                        @if(request('role'))
                            | Role: <strong>{{ ucfirst(request('role')) }}</strong>
                        @endif
                        ({{ $users->total() }} results)
                    </div>
                @endif

                <div class="card-body table-border-style">
                    <form id="bulkForm" action="{{ route('users.bulk-delete') }}" method="POST">
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
                                        <th><x-sortable-header column="name" label="Name" currentSort="name" /></th>
                                        <th><x-sortable-header column="username" label="Username" /></th>
                                        <th><x-sortable-header column="email" label="Email" /></th>
                                        <th>Role</th>
                                        <th><x-sortable-header column="created_at" label="Created" /></th>
                                        <th style="width:12%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="ids[]" value="{{ $user->id }}" 
                                                       class="form-check-input row-checkbox">
                                            </td>
                                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    <span class="badge bg-info">{{ ucfirst($role->name) }}</span>
                                                @endforeach
                                            </td>
                                            <td><small>{{ $user->created_at->format('d M Y H:i') }}</small></td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->username) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->username) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" 
                                                            data-fullname="{{ $user->name }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">No users found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                    
                    <div class="mt-4">{{ $users->appends(request()->query())->links() }}</div>
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
                    title: 'Delete ' + checked.length + ' users?',
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
