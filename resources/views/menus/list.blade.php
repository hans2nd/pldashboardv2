<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

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
                                    <th>Name</th>
                                    <th>Key</th>
                                    <th>Type</th>
                                    <th>Route</th>
                                    <th>Status</th>
                                    <th style="width:20%;">Action</th>
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
                                        <td>{{ $menu->route ?? '-' }}</td>
                                        <td>
                                            @if($menu->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
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
                                            <td><small>{{ $child->route ?? '-' }}</small></td>
                                            <td>
                                                @if($child->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
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
                                                <td><small>{{ $grandchild->route ?? '-' }}</small></td>
                                                <td>
                                                    @if($grandchild->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
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
                                        <td colspan="7" class="text-center py-4">
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
