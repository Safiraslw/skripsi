<?php
require "proses/session.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/DataTables/DataTables-1.13.5/css/dataTables.bootstrap5.min.css" />
    <title>Sistem Prediksi</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        body::-webkit-scrollbar {
            display: none;
        }

        .input {
            border: 0;
            border-bottom: 1px solid #000;
            width: 300px;
            background-color: #fff;
        }

        .card-body .row {
            margin-top: 50px;
        }

        form input[type="text"]:focus {
            outline-width: 0;
        }

        form input[type="datetime-local"]:focus {
            outline-width: 0;
        }

        form select:focus {
            outline-width: 0;
        }

        .button {
            /* margin-left: 5px; */
            margin-top: 50px;
            text-decoration: none;
            color: #fff;
            padding: 6px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- START SIDEBAR -->
        <?php
        require "sidebar.php";
        ?>
        <!-- END SIDEBAR -->
        <div class="main">
            <!-- START NAVBAR -->
            <?php
            require "navbar.php";
            ?>
            <!-- END NAVBAR -->
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Tambah Data Uji</h3>
                        <div class="col-12">
                            <div class="card border-0">
                                <div class="card-body">
                                    <form action="proses/proses_tambah_data_uji.php" method="POST">
                                        <div class="row">
                                            <div class="div col-lg-6">
                                                <h5>Kode Produk</h5>
                                                <!-- <input type="text" name="kode_produk" class="input"> -->
                                                <select name="kode_produk" class="input" onchange="showProductName()" id="produkSelect">
                                                    <option value="0">Pilih</option>
                                                    <option value="B01">B01</option>
                                                    <option value="B02">B02</option>
                                                </select>
                                            </div>
                                            <div class="div col-lg-6">
                                                <h5>Nama Produk</h5>
                                                <input type="text" name="nama_produk" class="input" id="nama_produk" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="div col-lg-6">
                                                <h5>Periode</h5>
                                                <input type="date" name="periode" class="input">
                                            </div>
                                            <div class="div col-lg-6">
                                                <h5>Jumlah Permintaan</h5>
                                                <input type="text" name="permintaan" class="input" placeholder="contoh masukan: 200">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="div col-lg-6">
                                                <h5>Jumlah Persediaan</h5>
                                                <input type="text" class="input" name="persediaan" placeholder="contoh masukan: 10">
                                            </div>
                                            <div class="div col-lg-6">
                                                <h5>Jumlah Penjualan</h5>
                                                <input type="text" class="input" name="penjualan" placeholder="contoh masukan: 190">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="div col-lg-6">
                                                <h5>Jumlah Produksi</h5>
                                                <input type="text" class="input" name="produksi" placeholder="contoh masukan: 190">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="button">
                                            <button class="btn btn-info" type="submit">Simpan</button>
                                            <a href="data_uji.php" class="btn btn-secondary">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function showProductName() {
            // Mendapatkan nilai yang dipilih dari dropdown
            var selectedValue = document.getElementById("produkSelect").value;
            var productName = "";

            // Menentukan nama produk berdasarkan nilai yang dipilih
            switch (selectedValue) {
                case "B01":
                    productName = "Udang Crispy";
                    break;
                case "B02":
                    productName = "Bileh Crispy";
                    break;
                default:
                    productName = "Pilih Produk";
            }

            // Menampilkan nama produk di kolom inputan lain
            document.getElementById("nama_produk").value = productName;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>



    <script src="assets/DataTables/DataTables-1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.13.5/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>