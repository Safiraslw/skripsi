<?php
require "koneksi.php";

$id_dtraining       = $_POST['id_dtraining'];
$kode_produk        = $_POST['kode_produk'];
$nama_produk        = $_POST['nama_produk'];
$tanggal            = $_POST['periode'];
$permintaan         = $_POST['permintaan'];
$persediaan         = $_POST['persediaan'];
$penjualan          = $_POST['penjualan'];
$produksi           = $_POST['produksi'];

//update data
$update = mysqli_query($conn, "UPDATE data_training SET kode_produk='$kode_produk', nama_produk='$nama_produk', 
periode='$tanggal', permintaan='$permintaan', persediaan='$persediaan', penjualan='$penjualan', produksi='$produksi' WHERE id_dtraining='$id_dtraining'");
if ($update) {
    echo "<script>alert('Data berhasil diperbarui')</script>";
    echo "<script>window.location='../data_training.php';</script>";
} else {
    echo "<script>alert('Data tidak berhasil diperbarui')</script>";
    echo "<script>window.location='../data_training.php';</script>";
}


// echo $kode_produk . "<br>";
// echo $nama_produk . "<br>";
// echo $tanggal . "<br>";
// echo $permintaan . "<br>";
// echo $persediaan . "<br>";
// echo $produksi . "<br>";
