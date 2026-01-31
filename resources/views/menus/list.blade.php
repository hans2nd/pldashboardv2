<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card bg-primary text-white">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalUsers }}</h3>
                            <small>Total Users</small>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-success text-white">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalRoles }}</h3>
                            <small>Total Roles</small>
                        </div>
                        <i class="fas fa-user-tag fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-warning text-white">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalPermissions }}</h3>
                            <small>Total Permissions</small>
                        </div>
                        <i class="fas fa-key fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-info text-white">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $totalMenus }}</h3>
                            <small>Total Menus</small>
                        </div>
                        <i class="fas fa-bars fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <h4 class="card-title">Menu Management</h4>
                        <a href="{{ route('menus.create') }}" class="btn btn-success btn-sm text-white">
                            <i class="fa fa-plus"></i> Add Menu
                        </a>
                    </div>
                </div>

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th><x-sortable-header column="name" label="Name" /></th>
                                    <th><x-sortable-header column="key" label="Key" /></th>
                                    <th><x-sortable-header column="type" label="Type" /></th>
                                    <th>Permission</th>
                                    <th><x-sortable-header column="is_active" label="Status" /></th>
                                    <th><x-sortable-header column="created_at" label="Created" /></th>
                                    <th style="width:12%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $menu)
                                    {{-- Parent Menu --}}
                                    <tr class="table-secondary">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="{{ $menu->icon ?? 'fas fa-folder' }}"></i>
                                            <strong>{{ $menu->name }}</strong>
                                        </td>
                                        <td><code>{{ $menu->key }}</code></td>
                                        <td><span class="badge bg-primary">{{ $menu->type }}</span></td>
                                        <td>
                                            @php $perm = $menu->getLinkedPermission(); @endphp
                                            @if($perm)
                                                <a href="{{ route('permissions.edit', $perm->id) }}" class="badge bg-success text-decoration-none">
                                                    <i class="fas fa-key"></i> {{ $menu->permission_name }}
                                                </a>
                                            @else
                                                <span class="badge bg-secondary">{{ $menu->permission_name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($menu->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td><small>{{ $menu->created_at->format('d M Y H:i') }}</small></td>
                                        <td>
                                            <a href="{{ route('menus.edit', $menu) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete" data-fullname="{{ $menu->name }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Child Menus --}}
                                    @foreach($menu->children as $child)
                                        <tr>
                                            <td></td>
                                            <td class="ps-4">
                                                <i class="fas fa-level-up-alt fa-rotate-90 me-2 text-muted"></i>
                                                <i class="{{ $child->icon ?? 'fas fa-file' }}"></i>
                                                {{ $child->name }}
                                            </td>
                                            <td><code>{{ $child->key }}</code></td>
                                            <td><span class="badge bg-info">{{ $child->type }}</span></td>
                                            <td>
                                                @php $childPerm = $child->getLinkedPermission(); @endphp
                                                @if($childPerm)
                                                    <a href="{{ route('permissions.edit', $childPerm->id) }}" class="badge bg-success text-decoration-none">
                                                        <i class="fas fa-key"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-secondary"><i class="fas fa-key"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($child->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td><small>{{ $child->created_at->format('d M Y H:i') }}</small></td>
                                            <td>
                                                <a href="{{ route('menus.edit', $child) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('menus.destroy', $child) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" data-fullname="{{ $child->name }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        {{-- Grandchild Menus --}}
                                        @foreach($child->children as $grandchild)
                                            <tr>
                                                <td></td>
                                                <td class="ps-5">
                                                    <i class="fas fa-level-up-alt fa-rotate-90 me-2 text-muted"></i>
                                                    <i class="{{ $grandchild->icon ?? 'fas fa-file' }}"></i>
                                                    {{ $grandchild->name }}
                                                </td>
                                                <td><code>{{ $grandchild->key }}</code></td>
                                                <td><span class="badge bg-secondary">{{ $grandchild->type }}</span></td>
                                                <td>
                                                    @php $gcPerm = $grandchild->getLinkedPermission(); @endphp
                                                    @if($gcPerm)
                                                        <a href="{{ route('permissions.edit', $gcPerm->id) }}" class="badge bg-success text-decoration-none">
                                                            <i class="fas fa-key"></i>
                                                        </a>
                                                    @else
                                                        <span class="badge bg-secondary"><i class="fas fa-key"></i></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($grandchild->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td><small>{{ $grandchild->created_at->format('d M Y H:i') }}</small></td>
                                                <td>
                                                    <a href="{{ route('menus.edit', $grandchild) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('menus.destroy', $grandchild) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-delete" data-fullname="{{ $grandchild->name }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada menu. <a href="{{ route('menus.create') }}">Buat menu pertama</a></p>
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
</x-layout>
