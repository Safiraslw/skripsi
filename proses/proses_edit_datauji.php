<?php
require "koneksi.php";

$id_duji           = $_POST['id_duji'];
$kode_produk        = $_POST['kode_produk'];
$nama_produk        = $_POST['nama_produk'];
$tanggal            = $_POST['periode'];
$permintaan         = $_POST['permintaan'];
$persediaan         = $_POST['persediaan'];
$produksi           = $_POST['produksi'];

//update data
$update = mysqli_query($conn, "UPDATE data_uji SET kode_produk='$kode_produk', nama_produk='$nama_produk', 
periode='$tanggal', permintaan='$permintaan', persediaan='$persediaan', produksi='$produksi' WHERE id_duji='$id_duji'");
if ($update) {
    echo "<script>alert('Data berhasil diperbaharui')</script>";
    echo "<script>window.location='../data_uji.php';</script>";
} else {
    echo "<script>alert('Data tidak berhasil diperbaharui')</script>";
    echo "<script>window.location='../data_uji.php';</script>";
}


// echo $kode_produk . "<br>";
// echo $nama_produk . "<br>";
// echo $tanggal . "<br>";
// echo $permintaan . "<br>";
// echo $persediaan . "<br>";
// echo $produksi . "<br>";
