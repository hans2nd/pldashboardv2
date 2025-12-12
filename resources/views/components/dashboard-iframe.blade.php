@props(['title', 'breadcrumbs', 'menu', 'iframe'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <h2 class="card-title">
                        <i class="fa fa-tachometer-alt"></i> Dashboard {{ $breadcrumbs }}
                    </h2>

                    {{-- Tombol Update hanya untuk yang berwenang --}}
                    @can('iframe edit')
                        <button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#updateIframeModal">
                            <i class="fa fa-pen-alt"></i> Update Data
                        </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                {{-- Konten Iframe --}}
                @if (isset($iframe) && $iframe->src && $iframe->src !== 'about:blank')
                    <iframe id="main-iframe" title="{{ $iframe->title ?? $breadcrumbs }}" width="100%" height="800"
                        src="{{ $iframe->src }}" frameborder="0" allowFullScreen="true">
                    </iframe>
                @else
                    {{-- Tampilan alternatif jika iframe belum dikonfigurasi --}}
                    <div class="alert alert-warning text-center" role="alert">
                        <h4><i class="fa fa-exclamation-triangle"></i> Dashboard Belum Dikonfigurasi</h4>
                        <p>Sumber (SRC) iframe untuk dashboard **{{ $breadcrumbs }}** belum diatur. Silakan klik tombol
                            "Update Data" di atas untuk memasukkan kode iframe Power BI.</p>
                        {{-- Frame kosong untuk inisialisasi JS --}}
                        <iframe id="main-iframe" title="{{ $breadcrumbs }}" src="about:blank"
                            style="display:none;"></iframe>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Form Update Iframe (Hanya untuk yang berwenang) --}}
@can('iframe edit')
    <div class="modal fade" id="updateIframeModal" tabindex="-1" aria-labelledby="updateIframeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateIframeModalLabel">🛠️ Konfigurasi Dashboard: {{ $breadcrumbs }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateIframeForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="iframe_code" class="form-label">Kode Iframe Lengkap (Paste dari Power BI
                                Embed)</label>
                            <textarea class="form-control" id="iframe_code" name="iframe_code" rows="6" required
                                placeholder="Contoh: <iframe title='Judul' width='100%' height='800' src='https://app.powerbi.com/view?r=...' frameborder='0' allowFullScreen='true'></iframe>">
                            @if (isset($iframe))
{{-- Menggunakan data dari prop $iframe --}}
                                <iframe title="{{ $iframe->title ?? $breadcrumbs }}" width="100%" height="800"
                                    src="{{ $iframe->src ?? 'about:blank' }}"
                                    frameborder="0" allowFullScreen="true">
                                </iframe>
@endif
                        </textarea>
                            <small class="form-text text-muted">Sistem akan otomatis mengekstrak `src` dan `title` dari kode
                                di atas.</small>
                            <div id="validation-errors" class="text-danger mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="save-iframe-btn">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan

{{-- Script AJAX yang Dibatasi oleh @push/Endpush --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            const iframeKey = '{{ $menu }}';

            $('#updateIframeForm').on('submit', function(e) {
                e.preventDefault();

                // ... (Logika menyimpan dan URL) ...
                $('#validation-errors').html('');
                $('#save-iframe-btn').attr('disabled', true).text('Menyimpan...');
                const url = '{{ route('iframe.update', ['key' => ':key']) }}'.replace(':key', iframeKey);

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // ... (Logika Success tetap sama) ...
                        if (response.success) {
                            $('#updateIframeModal').modal('hide');

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            // Penanganan error jika Controller mengembalikan success: false (misal: gagal ekstrak SRC)
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Update!',
                                html: `<strong>Pesan Server:</strong> ${response.message}`,
                                footer: 'Silakan periksa kembali kode iframe Anda.'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan tidak terduga.';
                        let errorDetails = '';

                        // Cek jika response memiliki JSON
                        if (xhr.responseJSON) {
                            const response = xhr.responseJSON;

                            // 1. Cek Error Validasi (Kode 422: Unprocessable Entity)
                            if (xhr.status === 422 && response.errors) {
                                errorMessage = 'Gagal Validasi Input!';
                                // Iterasi melalui semua error validasi yang dikirim Laravel
                                errorDetails = '<ul>';
                                for (const key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        // key adalah nama field, response.errors[key] adalah array pesan
                                        errorDetails +=
                                            `<li>**${key}**: ${response.errors[key].join(', ')}</li>`;
                                    }
                                }
                                errorDetails += '</ul>';
                            }
                            // 2. Cek Error Kustom dari Controller (Misal: Gagal Ekstrak SRC)
                            else if (response.message) {
                                errorMessage = 'Gagal Operasi!';
                                errorDetails = response.message;
                            }
                        } else {
                            // Error umum (misal: 500 Internal Server Error, 404 Not Found)
                            errorMessage = `Kode Error HTTP: ${xhr.status}`;
                            errorDetails =
                                `Terjadi kesalahan pada server. Status: ${xhr.statusText}`;
                        }

                        // Tampilkan SweetAlert ERROR dengan detail
                        Swal.fire({
                            icon: 'error',
                            title: errorMessage,
                            html: `
                                <div style="text-align: left;">
                                    ${errorDetails}
                                </div>
                            `,
                            footer: 'Periksa Input Iframe dan Status Server.'
                        });

                        // Pastikan tombol diaktifkan kembali
                        $('#save-iframe-btn').attr('disabled', false).text('Simpan Perubahan');
                    }
                });
            });

            // ... (Logika Modal Show tetap sama) ...
        });
    </script>
@endpush
