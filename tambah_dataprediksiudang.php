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
    <title>Document</title>
    <style>
        body::-webkit-scrollbar {
            display: none;
        }

        .content {
            position: relative;
            align-items: center;
            margin-right: 20px;
            margin-left: 50px;
        }

        .card {
            margin-right: 20px;
            margin-left: 50px;
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

<body style="background-color: #668FB3;">
    <div class="row">
        <div class="col-2">
            <!-- START SIDEBAR -->
            <?php
            require "sidebar.php";
            ?>
            <!-- END SIDEBAR -->
        </div>
        <div class="col-10">
            <!-- START CONTENT -->
            <div class="col-lg-12">
                <div class="content">
                    <h3>Tambah Data Training</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="proses/proses_tambah_data_prediksi_udang.php" method="POST">
                            <div class="row">
                                <div class="div col-lg-6">
                                    <h5>Kode Produk</h5>
                                    <input type="text" name="kode_produk" class="input">
                                </div>
                                <div class="div col-lg-6">
                                    <h5>Nama Produk</h5>
                                    <input type="text" name="nama_produk" class="input">
                                </div>
                            </div>
                            <div class="row">
                                <div class="div col-lg-6">
                                    <h5>Periode</h5>
                                    <input type="date" name="periode" class="input">
                                </div>
                                <div class="div col-lg-6">
                                    <h5>Permintaan</h5>
                                    <input type="text" name="permintaan" class="input">
                                </div>
                            </div>
                            <div class="row">
                                <div class="div col-lg-6">
                                    <h5>Persediaan</h5>
                                    <input type="text" class="input" name="persediaan">
                                </div>
                                <div class="div col-lg-6">
                                    <h5>Produksi</h5>
                                    <input type="text" class="input" name="produksi">
                                </div>
                            </div>
                            <br>
                            <div class="button">
                                <button class="btn btn-dark" type="submit" style="background-color: #1c1c1c;">Simpan</button>
                                <button class="btn btn-dark" type="reset" style="background-color: #1c1c1c;">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end content -->
            </div>
            <!-- END CONTENT -->
        </div>
    </div>


    <script src="assets/DataTables/DataTables-1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.13.5/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>