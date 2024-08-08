<?php
require "session.php";

$kode_produk        = $_POST['kode_produk'];
$nama_produk        = $_POST['nama_produk'];
$tanggal            = $_POST['periode'];
$permintaan         = $_POST['permintaan'];
$persediaan         = $_POST['persediaan'];
$penjualan          = $_POST['penjualan'];
$produksi           = $_POST['produksi'];

if (empty($kode_produk) || empty($nama_produk) || empty($tanggal) || empty($permintaan) || empty($persediaan) || empty($penjualan) || empty($produksi)) {
    echo "<script>alert('Semua field harus diisi');</script>";
    echo "<script>window.location='../tambah_datauji.php';</script>";
} else {
    if (!is_numeric($permintaan) || !is_numeric($persediaan) || !is_numeric($penjualan) || !is_numeric($produksi)) {
        echo "<script>alert('Permintaan, persediaan, penjualan, dan produksi harus berupa angka');</script>";
        echo "<script>window.location='../tambah_datauji.php';</script>";
    } else {
        $sql    = mysqli_query($conn, "INSERT INTO data_uji (kode_produk, nama_produk, periode, permintaan, persediaan, penjualan, produksi)
            VALUES ('$kode_produk','$nama_produk','$tanggal','$permintaan','$persediaan','$penjualan','$produksi')");
        if ($sql) {
            echo "<script>alert('Data uji berhasil ditambah')</script>";
            echo "<script>window.location='../data_uji.php';</script>";
        } else {
            echo "<script>alert('Data uji tidak berhasil ditambah')</script>";
            echo "<script>window.location='../tambah_datauji.php';</script>";
        }
    }
}
