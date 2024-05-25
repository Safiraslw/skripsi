<?php
    require "koneksi.php";

    $id_duji = $_POST['id_duji'];

        //update data
        $delete = mysqli_query($conn, "DELETE FROM data_uji WHERE id_duji='$id_duji'");
        if($delete){
            echo "<script>alert('Data berhasil dihapus.')</script>";
            echo "<script>window.location='../data_uji.php';</script>";
        }else {
            echo "<script>alert('Data tidak berhasil dihapus.')</script>";
            echo "<script>window.location='../data_uji.php';</script>";
        }
?>