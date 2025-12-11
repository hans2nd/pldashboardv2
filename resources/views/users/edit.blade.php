<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Form Edit Users
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->username) }}" method="POST"
                        class="form-confirm bg-white p-4 rounded shadow"
                        data-message="Yakin ingin mengubah data user ini?" data-fullname="{{ $user->name }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="fullname" class="control-label" id="fullname">Full Name</label>
                            <input type="text"
                                class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" id="fullname"
                                name="fullname" placeholder="Enter Your Full Name"
                                value="{{ $user->name ?? old('fullname') }}" required>
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
                                name="username" placeholder="Enter your username for app"
                                value="{{ $user->username ?? old('username') }}" required>
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
                                value="{{ $user->email ?? old('email') }}">
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
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $role }}"
                                            {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">-- Pilih Role --</option>
                                @endif
                            </select>
                            @if ($errors->has('role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('role') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="password" class="control-label" id="password">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    id="password" name="password" placeholder="Enter your password"
                                    value="{{ old('password', $user->password) }}" disabled>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                {{-- Tombol untuk memicu Modal --}}
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#changePasswordModal">
                                    <i class="fas fa-key"></i> Change Password
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="control-label" id="password_confirmation">Confirm
                                Password</label>
                            <input type="password"
                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm your password" value="{{ old('password_confirmation') }}"
                                disabled>
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


    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password untuk {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Form yang akan memanggil route baru --}}
                <form id="changePasswordForm" action="{{ route('users.password.update', $user->username) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="new_password" class="control-label">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="password" required
                                placeholder="Masukkan Password Baru">
                            {{-- Tambahkan error feedback di sini jika menggunakan Livewire/Alpine atau JS, atau pastikan error kembali ke modal --}}
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation" class="control-label">Konfirmasi Password
                                Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="password_confirmation" required placeholder="Ulangi Password Baru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        @if ($errors->any())
            // Periksa apakah error berasal dari field password (yang ada di modal)
            if (
                '{{ $errors->has('password') }}' ||
                '{{ $errors->has('password_confirmation') }}'
            ) {
                // Tampilkan kembali modal jika ada error password
                var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                myModal.show();
            }
        @endif
    </script>
</x-layout>
