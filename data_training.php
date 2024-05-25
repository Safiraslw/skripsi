<?php
require "proses/session.php";

$sql = mysqli_query($conn, "SELECT * FROM data_training");

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
                    <h3>Data Training</h3>
                    <div class="card-body">
                        <div class="data_table">
                            <a class='btn  btn-success btn-flat' href='tambah_datatraining.php' style="margin-bottom: 10px;">Tambah Data</a>
                            <table id="example" class="table table-striped" style="width:100%; margin-bottom: 10px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Periode</th>
                                        <th>Permintaan</th>
                                        <th>Persediaan</th>
                                        <th>Prediksi</th>
                                        <th>Aksi</th>
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
                                            <td>
                                                <button type="button" class="btn btn-dark link-dark" data-bs-toggle="modal" data-bs-target="#exampleModaledit<?php echo $no ?>" style="background-color: #727c85;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </button>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="exampleModaledit<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Edit Data Training
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="proses/proses_edit_datatraining.php">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="id_dtraining" value="<?php echo $data['id_dtraining'] ?>">
                                                                        <div class="div col-lg-4">
                                                                            <label for="recipient-name" class="form-label">Kode Produk</label>
                                                                            <input type="text" name="kode_produk" class="input" value="<?php echo $data['kode_produk'] ?>">
                                                                        </div>
                                                                        <div class="div col-lg-4">
                                                                            <label for="recipient-name" class="form-label">Nama Produk</label>
                                                                            <input type="text" name="nama_produk" class="input" value="<?php echo $data['nama_produk'] ?>">
                                                                        </div>

                                                                        <div class="div col-lg-4">
                                                                            <label for="recipient-name" class="form-label">Periode</label><br>
                                                                            <input type="date" class="input" name="periode" value="<?php echo $data['periode'] ?>">
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row">
                                                                        <div class="div col-lg-4">
                                                                            <label for="recipient-name" class="form-label">Permintaan</label><br>
                                                                            <input type="text" class="input" name="permintaan" value="<?php echo $data['permintaan'] ?>">
                                                                        </div>
                                                                        <div class="div col-lg-4">
                                                                            <label for="recipient-name" class="form-label">Persediaan</label>
                                                                            <input type="text" class="input" name="persediaan" value="<?php echo $data['persediaan'] ?>">
                                                                        </div>
                                                                        <div class="div col-lg-4">
                                                                            <label for="recipient-name" class="form-label">Produksi</label>
                                                                            <input type="text" class="input" name="produksi" value="<?php echo $data['produksi'] ?>">
                                                                        </div>
                                                                    </div><br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-dark">Ubah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit -->
                                                <!-- button delete -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModaldelete<?php echo $no ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>
                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="exampleModaldelete<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Training</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="proses/proses_delete_datatraining.php">
                                                                <input type="hidden" name="id_dtraining" value="<?php echo $data['id_dtraining'] ?>">
                                                                <div class="modal-body">
                                                                    Yakin ingin menghapus produk data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-dark">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Delete -->
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
                    "lengthMenu": "Menampilkan _MENU_ Masukan Data Training",
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

        function download() {
            print()
        }
    </script>

    <script src="assets/DataTables/DataTables-1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.13.5/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>