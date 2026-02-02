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
                {{-- Konten Embed --}}
                @if (isset($iframe) && $iframe->embed_type === 'jotform' && $iframe->embed_code)
                    {{-- JotForm Embed --}}
                    <div id="jotform-container">
                        {!! $iframe->embed_code !!}
                    </div>
                    {{-- JotForm Script --}}
                    <script>
                        (function(doc, id){
                            var scripts = doc.getElementsByTagName("script")[0];
                            if (!doc.getElementById(id)){
                                var script = doc.createElement("script");
                                script.async = 1;
                                script.id = id;
                                script.src = "https://cdn.jotfor.ms/s/umd/latest/for-report-embed.js";
                                scripts.parentNode.insertBefore(script, scripts);
                            }
                        })(document, "jotform-async");
                    </script>
                @elseif (isset($iframe) && $iframe->src && $iframe->src !== 'about:blank' && !str_starts_with($iframe->src, 'jotform://'))
                    {{-- Regular Iframe (Power BI, etc) --}}
                    <iframe id="main-iframe" title="{{ $iframe->title ?? $breadcrumbs }}" width="100%" height="800"
                        src="{{ $iframe->src }}" frameborder="0" allowFullScreen="true">
                    </iframe>
                @else
                    {{-- Tampilan alternatif jika belum dikonfigurasi --}}
                    <div class="alert alert-warning text-center" role="alert">
                        <h4><i class="fa fa-exclamation-triangle"></i> Dashboard Belum Dikonfigurasi</h4>
                        <p>Sumber data untuk dashboard <strong>{{ $breadcrumbs }}</strong> belum diatur. Silakan klik tombol
                            "Update Data" di atas untuk memasukkan kode embed Power BI atau JotForm.</p>
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
                        {{-- Info Current Type --}}
                        @if(isset($iframe) && $iframe->embed_type)
                            <div class="alert alert-info mb-3">
                                <i class="fa fa-info-circle"></i>
                                <strong>Tipe saat ini:</strong> 
                                {{ $iframe->embed_type === 'jotform' ? 'JotForm Report' : 'Power BI / Iframe' }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="iframe_code" class="form-label">
                                <i class="fa fa-code"></i> Kode Embed (Power BI atau JotForm)
                            </label>
                            <textarea class="form-control" id="iframe_code" name="iframe_code" rows="8" required
                                placeholder="Paste kode embed di sini...

Contoh Power BI:
<iframe title='Dashboard' width='100%' height='800' src='https://app.powerbi.com/view?r=...' frameborder='0' allowFullScreen='true'></iframe>

Contoh JotForm:
<div class='jotform-embed' data-id='25277948238707105' data-type='interactive'></div>">@if (isset($iframe))
@if($iframe->embed_type === 'jotform')
{{ $iframe->embed_code }}
@else
<iframe title="{{ $iframe->title ?? $breadcrumbs }}" width="100%" height="800"
    src="{{ $iframe->src ?? 'about:blank' }}"
    frameborder="0" allowFullScreen="true">
</iframe>
@endif
@endif</textarea>
                            <small class="form-text text-muted">
                                <i class="fa fa-magic"></i> Sistem akan <strong>otomatis mendeteksi</strong> tipe embed (Power BI atau JotForm) dari kode yang Anda masukkan.
                            </small>
                            <div id="validation-errors" class="text-danger mt-2"></div>
                        </div>

                        {{-- Help Section --}}
                        <div class="accordion" id="helpAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingHelp">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                                        <i class="fa fa-question-circle me-2"></i> Cara Mendapatkan Kode Embed
                                    </button>
                                </h2>
                                <div id="collapseHelp" class="accordion-collapse collapse" aria-labelledby="headingHelp"
                                    data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><i class="fa fa-chart-bar text-warning"></i> Power BI</h6>
                                                <ol class="small">
                                                    <li>Buka report di Power BI</li>
                                                    <li>Klik <strong>File → Embed report → Website or portal</strong></li>
                                                    <li>Copy kode iframe yang muncul</li>
                                                    <li>Paste di form di atas</li>
                                                </ol>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><i class="fa fa-wpforms text-success"></i> JotForm</h6>
                                                <ol class="small">
                                                    <li>Buka report di JotForm</li>
                                                    <li>Klik <strong>Share → Embed</strong></li>
                                                    <li>Pilih <strong>Interactive</strong></li>
                                                    <li>Copy kode embed (div + script)</li>
                                                    <li>Paste di form di atas</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="save-iframe-btn">
                            <i class="fa fa-save"></i> Simpan Perubahan
                        </button>
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
                $('#save-iframe-btn').attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
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
                            // Penanganan error jika Controller mengembalikan success: false
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Update!',
                                html: `<strong>Pesan Server:</strong> ${response.message}`,
                                footer: 'Silakan periksa kembali kode embed Anda.'
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
                                            `<li><strong>${key}</strong>: ${response.errors[key].join(', ')}</li>`;
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
                            footer: 'Periksa Input Embed dan Status Server.'
                        });

                        // Pastikan tombol diaktifkan kembali
                        $('#save-iframe-btn').attr('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    }
                });
            });

            // ... (Logika Modal Show tetap sama) ...
        });
    </script>
@endpush
