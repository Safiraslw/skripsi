<?php
    require "koneksi.php";

    $id_hasil = $_POST['id_hasil'];

        //update data
        $delete = mysqli_query($conn, "DELETE FROM tabel_hasil WHERE id_hasil='$id_hasil'");
        if($delete){
            echo "<script>alert('Data berhasil dihapus.')</script>";
            echo "<script>window.location='../prediksi_bileh.php';</script>";
        }else {
            echo "<script>alert('Data tidak berhasil dihapus.')</script>";
            echo "<script>window.location='../prediksi_bileh.php';</script>";
        }
?>