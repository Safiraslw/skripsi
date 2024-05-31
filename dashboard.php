<?php
require "proses/session.php";

$query = mysqli_query($conn, "SELECT * FROM data_training");
$query1 = mysqli_query($conn, "SELECT * FROM data_uji");

$jumlah_datatraining = mysqli_num_rows($query);
$jumlah_datauji = mysqli_num_rows($query1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col-3">
            <!-- START SIDEBAR -->
            <?php
            require "sidebar.php";
            ?>
            <!-- END SIDEBAR -->
        </div>
        <div class="col-9">

            <!-- START CONTENT -->
            <div class="col-lg-12">
                <div class="row mt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body" style="background-color: #bdd4e9;">
                                    <h5 class="card-title" style="text-align: justify;">
                                        <img src="image/udang.jpg" class="img me-2" style="float: left; width: 30%;">
                                    </h5>
                                    <center>
                                        <p class="card-text"><?php echo number_format($jumlah_datatraining, 0, ",", ".") ?></p>
                                    </center>
                                    <center>
                                        Data Training
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-transparent">
                                <div class="card-body" style="background-color: #bdd4e9;">
                                    <h5 class="card-title" style="text-align: justify;">
                                        <img src="image/udang.jpg" class="img me-2" style="float: left; width: 30%;">
                                    </h5>
                                    <center>
                                        <p class="card-text"><?php echo number_format($jumlah_datauji, 0, ",", ".") ?></p>
                                    </center>
                                    <center>
                                        Data Uji
                                    </center>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>