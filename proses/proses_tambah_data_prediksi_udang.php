<?php
require "session.php";

$kode_produk        = $_POST['kode_produk'];
$nama_produk        = $_POST['nama_produk'];
$tanggal            = $_POST['periode'];
$permintaan         = $_POST['permintaan'];
$persediaan         = $_POST['persediaan'];
$produksi           = $_POST['produksi'];


$sql    = mysqli_query($conn, "INSERT INTO tabel_hasil (kode_produk, nama_produk, periode, permintaan, persediaan, produksi)
            VALUES ('$kode_produk','$nama_produk','$tanggal','$permintaan','$persediaan','$produksi')");
if ($sql) {
    echo "<script>alert('Data training berhasil ditambah')</script>";
    echo "<script>window.location='../prediksi_udang.php';</script>";
    // header("Location: ../gardu");
} else {
    echo "<script>alert('Data training tidak berhasil ditambah')</script>";
    // header("Location: ../gardu");
    echo "<script>window.location='../tambah_dataprediksiudang.php';</script>";
}
