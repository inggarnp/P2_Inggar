<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Application Letter</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .preview-container,
            .preview-container * {
                visibility: visible;
            }

            .preview-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .form-card,
            .button-list,
            .card-header,
            .page-title-box {
                display: none !important;
            }
        }

        .page-title-box {
            padding: 30px 0 20px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .preview-card {
            background: white;
            padding: 40px;
            min-height: 800px;
        }

        .preview-container {
            font-family: 'Times New Roman', serif;
            line-height: 1.8;
        }

        .preview-content {
            margin-top: 30px;
        }

        .preview-content h5 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .preview-content p {
            margin-bottom: 15px;
            text-align: justify;
        }

        .signature-section {
            margin-top: 50px;
        }

        .btn-action {
            min-width: 120px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #495057;
        }

        .sticky-preview {
            position: sticky;
            top: 20px;
        }

        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
    </style>

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

    <div class="container-custom">
        
        <!-- Page Title -->
        <div class="page-title-box">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="page-title">
                    <iconify-icon icon="solar:document-text-bold-duotone" class="me-2"></iconify-icon>
                    Data Surat Lamaran
                </h1>
                <button type="button" class="btn btn-soft-dark" id="light-dark-mode">
                    <iconify-icon icon="solar:moon-bold-duotone" class="fs-20"></iconify-icon>
                </button>
            </div>
            <p class="text-muted">Buat dan preview surat lamaran pekerjaan Anda</p>
        </div>

        <div class="row">
            <!-- Form Column -->
            <div class="col-xl-6 col-lg-6">
                <div class="card form-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <iconify-icon icon="solar:pen-bold-duotone" class="me-1"></iconify-icon>
                            Form Data Surat Lamaran
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="lamaranForm">
                            
                            <!-- Kota & Tanggal -->
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Kota & Tanggal</label>
                                <input type="text" class="form-control" id="tanggal" placeholder="Contoh: Bandung, 30 Januari 2026">
                            </div>

                            <!-- Subjek Surat -->
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek Surat</label>
                                <input type="text" class="form-control" id="subject" placeholder="Contoh: Lamaran Pekerjaan - Posisi Web Developer">
                            </div>

                            <!-- Penerima & Alamat -->
                            <div class="mb-3">
                                <label for="penerima" class="form-label">Penerima & Alamat</label>
                                <textarea class="form-control" id="penerima" rows="4" placeholder="Contoh:&#10;HRD PT. Budiman&#10;Jl. Sudirman No 123&#10;Jakarta Pusat"></textarea>
                            </div>

                            <!-- Paragraf 1 (Pembuka) -->
                            <div class="mb-3">
                                <label for="p1" class="form-label">Paragraf 1 (Pembuka)</label>
                                <textarea class="form-control" id="p1" rows="3" placeholder="Tuliskan paragraf pembuka surat lamaran..."></textarea>
                            </div>

                            <!-- Paragraf 2 (Isi) -->
                            <div class="mb-3">
                                <label for="p2" class="form-label">Paragraf 2 (Isi)</label>
                                <textarea class="form-control" id="p2" rows="4" placeholder="Tuliskan isi/alasan melamar pekerjaan..."></textarea>
                            </div>

                            <!-- Paragraf 3 (Penutup) -->
                            <div class="mb-3">
                                <label for="p3" class="form-label">Paragraf 3 (Penutup)</label>
                                <textarea class="form-control" id="p3" rows="3" placeholder="Tuliskan paragraf penutup surat lamaran..."></textarea>
                            </div>

                            <!-- Nama Penyusun -->
                            <div class="mb-4">
                                <label for="nama_penyusun" class="form-label">Nama Penyusun</label>
                                <input type="text" class="form-control" id="nama_penyusun" placeholder="Nama lengkap Anda">
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-lg" id="btnSimpan">
                                    <i class="bx bx-save me-1"></i> Simpan Surat
                                </button>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-success w-100" id="btnPrint">
                                            <i class="bx bx-printer me-1"></i> Cetak PDF
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-danger w-100" id="btnClear">
                                            <i class="bx bx-trash me-1"></i> Clear
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Preview Column -->
            <div class="col-xl-6 col-lg-6">
                <div class="card sticky-preview">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <iconify-icon icon="solar:eye-bold-duotone" class="me-1"></iconify-icon>
                            Preview Surat Lamaran
                        </h4>
                    </div>
                    <div class="card-body preview-card">
                        <div class="preview-container">
                            
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <h2 style="font-size: 24px; font-weight: bold; color: #2c3e50;">
                                    <span id="p-fase">JOB APPLICATION LETTER</span>
                                </h2>
                                <hr style="border: 1px solid #3498db; width: 60%; margin: 10px auto;">
                            </div>
                            
                            <div class="text-end mb-4">
                                <p><span id="p-tanggal">Bandung, 30 Januari 2026</span></p>
                            </div>

                            <!-- Subject -->
                            <div class="preview-content">
                                <h5><span id="p-subject">Subject Job Application</span></h5>
                                
                                <!-- Recipient -->
                                <p>Dear,</p>
                                <p>
                                    <span id="p-penerima">
                                        HRD PT. Budiman<br>
                                        Jl. Sudirman No 123<br>
                                        Jakarta Pusat
                                    </span>
                                </p>
                                
                                <br>
                                
                                <!-- Salutation -->
                                <p><strong>Dear Sir/Madam,</strong></p>
                                
                                <!-- Paragraph 1 -->
                                <p><span id="p-p1">Dengan hormat, saya membuat surat lamaran ini untuk mengajukan diri sebagai kandidat pada posisi yang tersedia di perusahaan Bapak/Ibu pimpin.</span></p>
                                
                                <!-- Paragraph 2 -->
                                <p><span id="p-p2">Dengan pengalaman dan keahlian yang saya miliki, saya yakin dapat memberikan kontribusi positif bagi perusahaan. Saya memiliki motivasi yang tinggi untuk berkembang dan belajar hal-hal baru.</span></p>
                                
                                <!-- Paragraph 3 -->
                                <p><span id="p-p3">Demikian surat lamaran ini saya buat dengan sebenar-benarnya. Besar harapan saya untuk dapat diterima di perusahaan yang Bapak/Ibu pimpin. Atas perhatian dan kesempatannya, saya ucapkan terima kasih.</span></p>
                                
                                <br>
                                
                                <!-- Signature -->
                                <div class="signature-section">
                                    <p>Sincerely,</p>
                                    <br>
                                    <br>
                                    <br>
                                    <p><strong><span id="p-nama_penyusun">Inggar Nugraha P</span></strong></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Footer -->
        <div class="text-center py-4 mt-4">
            <p class="text-muted mb-0">
                <script>document.write(new Date().getFullYear())</script> &copy; Sistem Surat Lamaran
            </p>
        </div>

    </div>

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('assets/js/vendor.js') }}"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Custom JavaScript for Live Preview -->
    <script>
        // Live Preview Update
        document.addEventListener('DOMContentLoaded', function() {
            
            // Function to update preview
            function updatePreview(inputId, previewId, isHtml = false) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                
                input.addEventListener('input', function() {
                    if (isHtml) {
                        preview.innerHTML = this.value.replace(/\n/g, '<br>');
                    } else {
                        preview.textContent = this.value || preview.textContent;
                    }
                });
            }

            // Setup all live preview bindings
            updatePreview('tanggal', 'p-tanggal');
            updatePreview('subject', 'p-subject');
            updatePreview('penerima', 'p-penerima', true);
            updatePreview('p1', 'p-p1');
            updatePreview('p2', 'p-p2');
            updatePreview('p3', 'p-p3');
            updatePreview('nama_penyusun', 'p-nama_penyusun');

        });

        // Print Button Handler
        document.getElementById("btnPrint").addEventListener("click", function() {
            window.print();
        });

        // Clear Button Handler
        document.getElementById("btnClear").addEventListener("click", function() {
            if (confirm("Apakah Anda yakin ingin menghapus semua data?")) {
                // Clear all text inputs
                document.querySelectorAll("input[type='text']").forEach(input => {
                    input.value = "";
                });

                // Clear all textareas
                document.querySelectorAll("textarea").forEach(textarea => {
                    textarea.value = "";
                });

                // Reset preview to default values
                document.getElementById("p-tanggal").textContent = "Bandung, 30 Januari 2026";
                document.getElementById("p-subject").textContent = "Subject Job Application";
                document.getElementById("p-penerima").innerHTML = "HRD PT. Budiman<br>Jl. Sudirman No 123<br>Jakarta Pusat";
                document.getElementById("p-p1").textContent = "Dengan hormat, saya membuat surat lamaran ini untuk mengajukan diri sebagai kandidat pada posisi yang tersedia di perusahaan Bapak/Ibu pimpin.";
                document.getElementById("p-p2").textContent = "Dengan pengalaman dan keahlian yang saya miliki, saya yakin dapat memberikan kontribusi positif bagi perusahaan. Saya memiliki motivasi yang tinggi untuk berkembang dan belajar hal-hal baru.";
                document.getElementById("p-p3").textContent = "Demikian surat lamaran ini saya buat dengan sebenar-benarnya. Besar harapan saya untuk dapat diterima di perusahaan yang Bapak/Ibu pimpin. Atas perhatian dan kesempatannya, saya ucapkan terima kasih.";
                document.getElementById("p-nama_penyusun").textContent = "Inggar Nugraha P";

                // Show success message
                alert("Data berhasil dihapus!");
            }
        });

        // Save Button Handler
        document.getElementById("btnSimpan").addEventListener("click", function() {
            // Here you can add AJAX call to save data to server
            // For now, just show a notification
            alert("Data surat berhasil disimpan!");
        });
    </script>

</body>

</html>