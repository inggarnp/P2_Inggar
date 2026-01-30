<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Inggar - Lamaran Application Letter</title>
    <link rel="stylesheet" href="{{ asset('assets/css/preview.css') }}">
    <style>
        .elemen-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .elemen-row {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .elemen-row input {
            flex: 1;
            padding: 8px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-remove {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 4px 6px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 10px;
            width: 22px;
            height: 28px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove:hover {
            background-color: #c82333;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            margin-top: 5px;
            width: fit-content;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        /* Button Styles */
        .button-list {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            width: 100%;
        }

        .button-list button {
            flex: 1;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        #btnSimpan:hover {
            background-color: #0056b3 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        #btnPrint:hover {
            background-color: #218838 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }

        #btnClear:hover {
            background-color: #c82333 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }
    </style>
</head>

<body>

    <h3 class="title">Data Surat Lamaran</h3>

    <div class="container">

        <!--left form-->
        <div class="left">
            <div id="step-a" class="step">
                <div class="form-group">
                    <label>Kota & Tanggal</label>
                    <input type="text" id="tanggal">
                </div>

                <div class="form-group">
                    <label>Subjek Surat</label>
                    <input type="text" id="subject">
                </div>

                <div class="form-group">
                    <label>Penerima & Alamat</label>
                    <textarea id="penerima"></textarea>
                </div>

                <div class="form-group">
                    <label>Parapraf 1 (Pembuka)</label>
                    <textarea id="p1"></textarea>
                </div>

                <div class="form-group">
                    <label>Paragraf 2 (Isi)</label>
                    <textarea id="p2"></textarea>
                </div>

                <div class="form-group">
                    <label>Paragraf 3 (Penutup)</label>
                    <textarea id="p3"></textarea>
                </div>


                <div class="form-group mb-3">
                    <label>Nama Penyusun</label>
                    <input type="text" id="nama_penyusun">
                </div>

                <div class="form-sections mb-3">
                    <div class="button-list">
                        <button type="button" class="btn btn-primary" id="btnSimpan" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 14px;">Simpan Surat</button>
                        <button type="button" class="btn btn-success" id="btnPrint" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 14px;">Cetak Surat (PDF)</button>
                        <button type="button" class="btn btn-danger" id="btnClear" style="background-color: #dc3535; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 14px;">Clear</button>
                    </div>
                </div>
            </div>
        </div>

        <!--right preview -->
        <div class="right">

            <div class="info-header">
                <img id="p-logo" class="logo" style="display:none;">

                <div class="info-text">
                    <h2><span id="p-fase">JOB APPLICATION LETTER</span></h2>
                    <hr>
                    <p><span id="p-tanggal">Bandung, 30 Januari 2026</span></p>
                </div>
            </div>

            <h5><span id="p-subject"> Subject Job Applicatian</span></h5>
            <p>Dear,</p>
            <p>
                <span id="p-penerima">
                    HRD PT. Budiman
                    <br>
                    Jl. Sudirman No 123
                    <br>
                    Jakarta Pusat
                </span>
            </p>
            <br>
            <p>dear</p>
            <p><span id="p-p1">dengan hormat saya membuat surat lamaran ini.</span></p>
            <p><span id="p-p2">dengan surat ini saya ingin melamar di divisi.</span></p>
            <p><span id="p-p3">semoga saya bisa di terima disini.</span></p>
            <br>
            <br>
            <p>Hormat Saya,</p>
            <br>
            <br>
            <br>
            <b><span id="p-nama_penyusun">Inggar Nugraha P</span></b>
        </div>


    </div>
    <!--js bagian print/cetak pdf-->
    <script>
        document.getElementById("btnPrint").addEventListener("click", () => {
            window.print();
        });
    </script>
    <!--js bagian clear-->
    <script>
        document.getElementById("btnClear").addEventListener("click", () => {
            if (confirm("Apakah Anda yakin ingin menghapus semua data?")) {
                document.querySelectorAll("input[type='text']").forEach(input => {
                    input.value = "";
                });

                document.querySelectorAll("textarea").forEach(textarea => {
                    textarea.value = "";
                });

                document.getElementById("p-tanggal").textContent = "Bandung, 30 Januari 2026";
                document.getElementById("p-subject").textContent = " Subject Job Applicatian";
                document.getElementById("p-penerima").innerHTML = "HRD PT. Budiman<br>Jl. Sudirman No 123<br>Jakarta Pusat";
                document.getElementById("p-p1").textContent = "dengan hormat saya membuat surat lamaran ini.";
                document.getElementById("p-p2").textContent = "dengan surat ini saya ingin melamar di divisi.";
                document.getElementById("p-p3").textContent = "semoga saya bisa di terima disini.";
                document.getElementById("p-nama_penyusun").textContent = "Inggar Nugraha P";

                alert("Data berhasil dihapus!");
            }
        });
    </script>
    <script src="{{ asset('assets/js/preview.js') }}"></script>
</body>

</html>