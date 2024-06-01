<?php
require "proses/session.php";

$query = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk = 'B02'");

$data = array();
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sistem Prediksi</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<style>
    .card-body {
        background-color: #fff;
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
    }

    .grafik{
        margin-top: 30px;
        position: relative;
        width: 100%;
        height: 500px;
    }
</style>

<body>
    <div class="wrapper">
        <!-- START SIDEBAR -->
        <?php
        require "sidebar.php";
        ?>
        <!-- END SIDEBAR -->
        <div class="main">
            <!-- START NAVBAR -->
            <?php
            require "navbar.php";
            ?>
            <!-- END NAVBAR -->
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Grafik Data Bileh Crispy</h3>
                        <div class="col-12">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="grafik">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil data dari PHP dan mengubahnya menjadi format JavaScript
        const dataFromPHP = <?php echo json_encode($data); ?>;

        // Memisahkan data untuk digunakan di Chart.js
        const periode = dataFromPHP.map(item => item.periode);
        const permintaan = dataFromPHP.map(item => item.permintaan);
        const persediaan = dataFromPHP.map(item => item.persediaan);
        const produksi = dataFromPHP.map(item => item.produksi);

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: periode,
                datasets: [{
                        label: 'Permintaan',
                        data: permintaan,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Persediaan',
                        data: persediaan,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Produksi',
                        data: produksi,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>