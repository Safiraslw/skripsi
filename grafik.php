<?php
require "proses/session.php";

$query = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk = 'B01'");

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
            <div class="col-lg-12" style="background-color: azure">
                <h3>Grafik Data Produksi Udang Crispy </h3>
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
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