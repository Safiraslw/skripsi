<?php
require "proses/session.php";

if (empty($_GET['inputmulai'])) {
    $sql = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk = 'B01'");
} else {
    $start = $_GET['inputmulai'];
    $to = $_GET['inputsampai'];
    $sql = mysqli_query($conn, "SELECT * FROM data_training WHERE periode BETWEEN '$start 00:00:00' AND '$to 00:00:00' AND kode_produk ='B01'");
}
$sqli = $sql;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/DataTables/DataTables-1.13.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/pdf.css">
    <title>Document</title>

    <style>
        body::-webkit-scrollbar {
            display: none;
        }

        .data_table {
            padding: 10px;
            box-shadow: 1px 3px 5px #aaaa;
            border-radius: 5px;
            font-size: small;
        }

        .content {
            position: relative;
            align-items: center;
            margin-right: 20px;
            margin-left: 50px;
        }

        .modal-body {
            background-color: #668FB3;
        }

        .card-body {
            background-color: #fff;
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .modal-body .input {
            border: 0;
            border-bottom: 1px solid #000;
            width: 200px;
            background-color: #668FB3;
            border-color: #fff;
            color: #fff;
        }

        .modal-body form input:focus {
            outline-width: 0;
        }

        .modal-body .form-label {
            color: #fff;
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
            <!-- start content -->
            <div class="col-12">
                <div class="content">
                    <div class="card-body">
                        <div class="data_table">
                            <h1 class="ms-0" style="text-align: center;">Laporan Produksi Udang</h1>
                            <div class="row">
                                <form method="GET" action="laporan_udang.php">
                                    <div class="row mb-2">
                                        <label for="inputmulai" class="col-sm-3 col-form-label">Strat From</label>
                                        <label for="inputsampai" class="col-sm-3 col-form-label">To</label>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control border-0" name="inputmulai" style="background-color: #F5F5DC;">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control border-0" name="inputsampai" style="background-color: #F5F5DC;">
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success">Preview</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="example" class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Periode</th>
                                        <th>Permintaan</th>
                                        <th>Persediaan</th>
                                        <th>Prediksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    while ($data = mysqli_fetch_array($sql)) {
                                        $no++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $no ?></th>
                                            <td><?php echo $data['kode_produk'] . "<br>"; ?></td>
                                            <td><?php echo $data['nama_produk'] . "<br>"; ?></td>
                                            <td><?php echo date('d F Y', strtotime($data['periode'])) . "<br>"; ?></td>
                                            <td><?php echo $data['permintaan'] . "<br>"; ?></td>
                                            <td><?php echo $data['persediaan'] . "<br>"; ?></td>
                                            <td><?php echo $data['produksi'] . "<br>"; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row mb-2">
                                <?php
                                if (empty($_GET['inputmulai']) or empty($_GET['inputsampai'])) {
                                    $select = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk = 'B01'");
                                    $url_cetak = "proses/pdf_udang.php";
                                } else {
                                    $start = $_GET['inputmulai'];
                                    $to = $_GET['inputsampai'];
                                    $select = mysqli_query($conn, "SELECT * FROM data_training WHERE periode BETWEEN '$start 00:00:00' AND '$to 00:00:00' AND kode_produk = 'B01'");
                                    $url_cetak = "proses/pdf_udang.php?inputmulai=" . $start . "&inputsampai=" . $to;
                                }
                                ?>
                                <div class="col-sm-3">
                                    <button class="btn" type="button" style="background-color: #D2B48C">
                                        <a href="<?php echo $url_cetak ?>" class="btn btn-sm">
                                            Print<i class="glyphicon glyphicon-download-alt"></i>
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end content -->
        </div>
    </div>

    <!-- Page level custom scripts -->
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({

                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],

                language: {
                    "decimal": "",
                    "emptyTable": "Tidak ada data yang tersedia di tabel",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ masukan",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 masukan",
                    "infoFiltered": "(Difilter dari _MAX_ total masukan)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Menampilkan _MENU_ Masukan Data Uji",
                    "loadingRecords": "Memuat...",
                    "processing": "Sedang di proses...",
                    "search": "Pencarian:",
                    "zeroRecords": "Arsip tidak ditemukan",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Lanjut",
                        "previous": "Kembali"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan urutan kolom ascending",
                        "sortDescending": ": aktifkan urutan kolon descending"
                    }
                }

            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script src="assets/DataTables/DataTables-1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.13.5/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>