<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Form Registrasi
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST"
                        class="form-confirm bg-white p-4 rounded shadow"
                        data-message="Yakin ingin menyimpan data user ini?" data-fullname="{{ old('fullname') }}">
                        @csrf
                        <div class="form-group">
                            <label for="fullname" class="control-label" id="fullname">Full Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" id="fullname"
                                name="fullname" placeholder="Enter Your Full Name" value="{{ old('fullname') }}"
                                required>
                            @if ($errors->has('fullname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fullname') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="username" class="control-label" id="username">User Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username"
                                name="username" placeholder="Enter your username for app" value="{{ old('username') }}"
                                required>
                            @if ($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label" id="email">Email (*)</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                id="email" name="email" placeholder="Enter your email"
                                value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="role" class="control-label" id="role">Role</label>
                            <select name="role" id="role"
                                class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $id => $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                                {{-- <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="sales" {{ old('role') == 'sales' ? 'selected' : '' }}>Sales</option>
                                <option value="logistic" {{ old('role') == 'logistic' ? 'selected' : '' }}>Logistic
                                </option> --}}
                            </select>
                            @if ($errors->has('role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('role') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label" id="password">Password</label>
                            <input type="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password"
                                name="password" placeholder="Enter your password" value="{{ old('password') }}"
                                required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="control-label" id="password_confirmation">Confirm
                                Password</label>
                            <input type="password"
                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm your password" value="{{ old('password_confirmation') }}"
                                required>
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>
                            Save</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
