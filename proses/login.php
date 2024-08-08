<?php
session_start();
include('koneksi.php');

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `tabel_akun` WHERE `username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $username = $row['username'];
        $password = $row['password'];


        if ($username == $username && $password == $password) {
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: ../dashboard.php");
        }
    } else {
        echo "<script>alert('Username atau Password Salah');</script>";
        echo "<script> window.location='../login.php';</script>";
        exit;
    }
}
?>