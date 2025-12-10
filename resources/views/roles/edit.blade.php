<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Form Add Roles
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="name" class="form-label">Role Name</label>
                        <div class="my-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Enter Your Role Name"
                                value="{{ old('name', $role->name) }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name_permission" class="form-label">Permissions</label>
                        <div class="form-group mb-3 d-flex flex-wrap gap-2">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="permission[]"
                                                    value="{{ $permission->name }}" class="selectgroup-input"
                                                    id="permission-{{ $permission->id }}"
                                                    {{ $rolePermissions->contains($permission->name) ? 'checked' : '' }} />
                                                <span for="permission-{{ $permission->id }}"
                                                    class="selectgroup-button">{{ $permission->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 btn-sm"><i class="fa fa-save"></i>
                            Save
                        </button>

                        <a href="{{ route('roles.index') }}" class="btn btn-danger mt-3 btn-sm"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
