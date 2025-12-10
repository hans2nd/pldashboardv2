<!-- Sweet Alert -->
<script src="{{ asset('assets/sweetalert2') }}/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ✅ Global flash messages

        @if (session('success_html'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: `{!! session('success_html') !!}`,
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 1500,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '{{ session('error') }}',
            });
        @endif

        @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: '{{ session('warning') }}',
            });
        @endif


        // ✅ Global Delete Confirmation
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const fullname = this.dataset.fullname ?? 'data ini'; // fallback jika tidak ada

                Swal.fire({
                    title: 'Konfirmasi Penghapusan?',
                    html: `Hapus akun <b>${fullname}</b>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // form.submit();
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar.',
                            didOpen: () => {
                                Swal.showLoading();
                                form.submit();
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });

        // ✅ Global FORM SUBMIT Confirmation (untuk simpan/update)
        document.querySelectorAll('.form-confirm').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Ambil teks dari atribut data-message (optional)
                const message = this.dataset.message ??
                    'Apakah Anda yakin ingin menyimpan data ini?';
                const fullname = this.dataset.fullname ? `<br><b>${this.dataset.fullname}</b>` :
                    '';

                Swal.fire({
                    title: 'Konfirmasi Simpan',
                    html: `${message}${fullname}`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Munculkan loading sebelum submit
                        Swal.fire({
                            title: 'Menyimpan data...',
                            text: 'Mohon tunggu, sedang menyimpan data.',
                            didOpen: () => {
                                Swal.showLoading();
                                setTimeout(() => form.submit(), 600);
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });

    });
</script>
