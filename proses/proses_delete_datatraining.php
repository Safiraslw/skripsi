<?php
    require "koneksi.php";

    $id_dtraining = $_POST['id_dtraining'];

        //update data
        $delete = mysqli_query($conn, "DELETE FROM data_training WHERE id_dtraining='$id_dtraining'");
        if($delete){
            echo "<script>alert('Data berhasil dihapus.')</script>";
            echo "<script>window.location='../data_training.php';</script>";
        }else {
            echo "<script>alert('Data tidak berhasil dihapus.')</script>";
            echo "<script>window.location='../data_training.php';</script>";
        }
?>