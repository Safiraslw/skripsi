<?php
require "proses/session.php";

$query = mysqli_query($conn, "SELECT * FROM tabel_hasil WHERE kode_produk = 'B02'");

// $data = mysqli_fetch_assoc($query)

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
    body::-webkit-scrollbar {
        display: none;
    }

    .grafik {
        margin-top: 30px;
        position: relative;
        width: 100%;
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
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <div class="card border-0">
                                    <div class="card-body" style="border-radius: 25px;">
                                        <center>
                                            <h6>Data 2022</h6>
                                        </center>
                                        <div class="grafik">
                                            <canvas id="myChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <div class="card border-0">
                                    <div class="card-body" style="border-radius: 25px;">
                                        <center>
                                            <h6>Data 2023</h6>
                                        </center>
                                        <div class="grafik">
                                            <canvas id="myChart4"></canvas>
                                        </div>
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

        // Fungsi untuk memfilter data berdasarkan tahun
        function filterDataByYear(data, year) {
            return data.filter(item => new Date(item.periode).getFullYear() === year);
        }

        // Mendapatkan data untuk masing-masing tahun
        const data2022 = filterDataByYear(dataFromPHP, 2022);
        const data2023 = filterDataByYear(dataFromPHP, 2023);

        // Memisahkan data untuk digunakan di Chart.js
        function prepareChartData(data) {
            return {
                periode: data.map(item => item.periode),
                permintaan: data.map(item => item.permintaan),
                persediaan: data.map(item => item.persediaan),
                penjualan: data.map(item => item.penjualan),
                hasil: data.map(item => item.hasil)
            };
        }

        // Menyiapkan data untuk masing-masing chart
        const chartData2022 = prepareChartData(data2022);
        const chartData2023 = prepareChartData(data2023);

        // Fungsi untuk membuat chart
        function createChart(ctx, data) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.periode,
                    datasets: [{
                            label: 'Permintaan',
                            data: data.permintaan,
                            backgroundColor: 'rgba(255, 0, 0, 0.2)',
                            borderColor: 'rgba(255, 0, 0, 1)',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: 'Persediaan',
                            data: data.persediaan,
                            backgroundColor: 'rgba(0, 0, 255, 0.2)',
                            borderColor: 'rgba(0, 0, 255, 1)',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: 'Penjualan',
                            data: data.penjualan,
                            backgroundColor: 'rgba(0, 255, 255, 0.2)',
                            borderColor: 'rgba(0, 255, 255, 1)',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: 'Hasil Prediksi',
                            data: data.hasil,
                            backgroundColor: 'rgba(0, 255, 0, 0.2)',
                            borderColor: 'rgba(0, 255, 0, 1)',
                            borderWidth: 1,
                            fill: false
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
        }

        // Membuat chart untuk masing-masing canvas
        createChart(document.getElementById('myChart3'), chartData2022);
        createChart(document.getElementById('myChart4'), chartData2023);
    </script>

</body>

</html>