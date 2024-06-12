<?php
session_start();

require "koneksi.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pass = md5($_POST['password']);

    $sql   = "INSERT INTO `tabel_akun`(`name`, `username`, `password`) VALUES ('$name','$username','$pass')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Register Akun Baru Berhasil');</script>";
        echo "<script> window.location='../login.php';</script>";
    } else {
        echo "<script>alert('Register Akun Baru Gagal');</script>";
        echo "<script> window.location='../form_register.php';</script>";
    }
}
?>