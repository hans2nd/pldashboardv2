<div class="modal fade" id="userChangePasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="userChangePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userChangePasswordModalLabel">Ubah Password Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="userChangePasswordForm" action="{{ route('user.self.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- TAMPILKAN PESAN ERROR GLOBAL (Jika ada error yang tidak terkait field) --}}
                    @if ($errors->any() && ($errors->has('current_password') || $errors->has('password')))
                        <div class="alert alert-danger" role="alert">
                            Mohon periksa kembali input Anda.
                        </div>
                    @endif

                    <div class="alert alert-warning" role="alert">
                        Anda harus memasukkan **Password Lama** untuk konfirmasi keamanan.
                    </div>

                    {{-- 1. PASSWORD LAMA --}}
                    <div class="form-group">
                        <label for="current_password" class="control-label">Password Lama</label>
                        <input type="password"
                            class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                            id="current_password" name="current_password" required>

                        {{-- FEEDBACK ERROR CURRENT PASSWORD --}}
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- 2. PASSWORD BARU --}}
                    <div class="form-group">
                        <label for="password" class="control-label">Password Baru</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            id="password" name="password" required placeholder="Minimal 8 karakter">

                        {{-- FEEDBACK ERROR PASSWORD BARU --}}
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- 3. KONFIRMASI PASSWORD --}}
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label">Konfirmasi Password Baru</label>
                        <input type="password"
                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                            id="password_confirmation" name="password_confirmation" required>

                        {{-- FEEDBACK ERROR KONFIRMASI --}}
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT: Membuka Modal Saat Ada Error --}}
@push('scripts')
    <script>
        // Hanya perlu bagian script di dalam push
        @if ($errors->any())
            // Cek apakah ada error validasi terkait field yang ada di modal ganti password
            if (
                '{{ $errors->has('current_password') }}' ||
                '{{ $errors->has('password') }}' ||
                '{{ $errors->has('password_confirmation') }}'
            ) {
                // Tampilkan kembali modal jika ada error (Bootstrap 5 syntax)
                var myModal = new bootstrap.Modal(document.getElementById('userChangePasswordModal'));
                myModal.show();
            }
        @endif
    </script>
@endpush
