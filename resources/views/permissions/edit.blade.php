<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Permission</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Enter permission name"
                                value="{{ old('name', $permission->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Permission
                            </button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            {{-- Permission Info Card --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Info Permission</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID</strong></td>
                            <td>{{ $permission->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Guard</strong></td>
                            <td><span class="badge bg-secondary">{{ $permission->guard_name }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Created</strong></td>
                            <td>{{ $permission->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated</strong></td>
                            <td>{{ $permission->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Linked Menus Card --}}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-bars me-2"></i>Linked Menus
                    </h4>
                    @php
                        $linkedMenus = \App\Models\DashboardMenu::findByPermission($permission->name);
                    @endphp
                    <span class="badge bg-info">{{ $linkedMenus->count() }}</span>
                </div>
                <div class="card-body">
                    @if($linkedMenus->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($linkedMenus as $linkedMenu)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <i class="{{ $linkedMenu->icon ?? 'fas fa-folder' }} me-2 text-muted"></i>
                                        {{ $linkedMenu->name }}
                                        @if($linkedMenu->parent)
                                            <small class="text-muted d-block ps-4">
                                                Parent: {{ $linkedMenu->parent->name }}
                                            </small>
                                        @endif
                                    </div>
                                    <a href="{{ route('menus.edit', $linkedMenu) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-unlink fa-2x mb-2"></i>
                            <p class="mb-0">Tidak ada menu yang terkait</p>
                            <small>Permission ini tidak digunakan oleh menu manapun</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
