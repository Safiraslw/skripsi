<?php
require "proses/session.php";

$query = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk='B01'");
$query1 = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk='B02'");
$query2 = mysqli_query($conn, "SELECT * FROM data_uji WHERE kode_produk='B01'");
$query3 = mysqli_query($conn, "SELECT * FROM data_uji WHERE kode_produk='B02'");
$query4 = mysqli_query($conn, "SELECT * FROM tabel_hasil WHERE kode_produk='B01'");
$query5 = mysqli_query($conn, "SELECT * FROM tabel_hasil WHERE kode_produk='B02'");

$datatraining1 = mysqli_num_rows($query);
$datatraining2 = mysqli_num_rows($query1);
$datauji1 = mysqli_num_rows($query2);
$datauji2 = mysqli_num_rows($query3);
$datahasil1 = mysqli_num_rows($query4);
$datahasil2 = mysqli_num_rows($query5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Prediksi</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/tabs.css">
</head>

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
                        <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                        <div class="row">
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-3" style="background-color: #ffff; border-radius: 25px;">
                                        <h3 class="mb-2 fw-bold">
                                            Jumlah Data Training
                                            <img src="image/data.png" class="img" style="float: right; width: 15%;">
                                        </h3>
                                        <p class="mb-2" style="font-size: 1em;"><?php echo "Data Udang ", " | ",  " Data Bileh "; ?></p>
                                        <p class="mb-2" style="font-size: 1em;"><?php echo "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp",
                                                                                number_format($datatraining1, 0, ",", "."), "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ",
                                                                                number_format($datatraining2, 0, ",", "."); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card  border-0">
                                    <div class="card-body py-3" style="background-color: #ffff; border-radius: 25px;">
                                        <h3 class="mb-2 fw-bold">
                                            Jumlah Data Uji
                                            <img src="image/data.png" class="img" style="float: right; width: 15%;">
                                        </h3>
                                        <p class="mb-2" style="font-size: 1em;"><?php echo "Data Udang ", " | ",  " Data Bileh "; ?></p>
                                        <p class="mb-2" style="font-size: 1em;"><?php echo "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp",
                                                                                number_format($datauji1, 0, ",", "."), "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ",
                                                                                number_format($datauji2, 0, ",", "."); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-3" style="background-color: #ffff; border-radius: 25px;">
                                        <h3 class="mb-2 fw-bold">
                                            Jumlah Data Prediksi
                                            <img src="image/data.png" class="img" style="float: right; width: 15%;">
                                        </h3>
                                        <p class="mb-2" style="font-size: 1em;"><?php echo "Data Udang ", " | ",  " Data Bileh "; ?></p>
                                        <p class="mb-2" style="font-size: 1em;"><?php echo "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp",
                                                                                number_format($datahasil1, 0, ",", "."), "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ",
                                                                                number_format($datahasil2, 0, ",", "."); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-2 fw-bold">Informasi Sistem</h3>
                                        <br>
                                        <ul class="nav-tabs card-header-tabs">
                                            <li class="tab active" data-tab="tab1">Informasi Menu</li>
                                            <li class="tab" data-tab="tab2">Sistem Prediksi Jumlah Produksi</li>
                                            <li class="tab" data-tab="tab3">Fuzzy Mamdani</li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">Pada sistem ini terdapat beberapa menu yang dapat diakses oleh pengguna
                                                seperti menu dashboard yang berisikan informasi mengenai sistem dan data-data apa saja yang digunakan dalam 
                                                sistem ini beserta jumlahnya. Kemudian ada menu data training yang menampilkan data-data yang digunakan sebagai 
                                                data training. Pada menu ini, pengguna dapat melakukan beberapa aksi seperti menambah data, mencari data, mengubah
                                                data dan menghapus data. Selanjutnya ada menu data uji yang menampilkan data-data yang digunakan sebagai 
                                                data uji. Pada menu ini, pengguna juga dapat melakukan beberapa aksi seperti menambah data, mencari data, mengubah
                                                data dan menghapus data. Selanjutnya ada menu prediksi, pada menu ini pengguna dapat memilih ingin melakukan prediksi 
                                                produk udang crispy atau bileh crispy. Lalu ada menu grafik, pada menu ini pengguna juga dapat memilih ingin melakukan prediksi 
                                                produk udang crispy atau bileh crispy. Selanjutnya ada menu laporan, pada menu ini pengguna juga dapat memilih ingin melakukan prediksi 
                                                produk udang crispy atau bileh crispy dan pengguna juga dapat memilih tanggal produksi yang ingin ditampilkan. Selain itu,
                                                pada menu laporan ini pengguna juga dapat mencetak laporan dalam bentuk pdf. Terakhir adalah menu logout, menu ini
                                                dapat digunakan pengguna untuk keluar dari sistem.
                                            </div>
                                            <div class="tab-pane" id="tab2">Secara umum, prediksi adalah suatu proses memperkirakan sesuatu 
                                                yang paling mungkin terjadi di masa depan berdasarkan informasi masa lalu dan sekarang yang dimiliki 
                                                secara sistematis. Dalam pengertian yang lebih spesifik, prediksi adalah perkiraan yang menggunakan 
                                                teknik-teknik tertentu. Prediksi tidak harus memberikan jawaban secara tepat dan akurat, 
                                                melainkan berusaha mencari jawaban sedekat mungkin. Dalam kegiatan produksi, 
                                                prediksi dilakukan untuk menentukan jumlah produk yang harus diproduksi untuk perencanaan ke depannya.
                                                Sistem prediksi jumlah produksi adalah sebuah sistem yang 
                                                menggunakan data historis dan teknik analisis statistik atau machine learning untuk memperkirakan 
                                                jumlah produk yang akan diproduksi dalam periode waktu tertentu di masa depan. 
                                                Tujuan utama dari sistem ini adalah membantu perusahaan dalam mengoptimalkan proses produksi, 
                                                mengelola persediaan, dan merencanakan sumber daya dengan lebih efektif.</div>
                                            <div class="tab-pane" id="tab3">Himpunan Fuzzy Ebrahim Mamdani pertama kali digunakan pada tahun 1975 
                                                dalam membangun sistem kontrol uap dan boiler. Metode ini berhasil digunkana dalam penelitian tersebut. 
                                                Sejak saat itu, metode mamdani sering digunakan karena metode ini merupakan metode yang pertama kali 
                                                dibangun dan berhasil diterapkan dalam rancang bangun sistem kontrol uap dan boiler. 
                                                Ada 4 tahapan dalam menggunakan metode fuzzy mamdani yaitu: fuzzifikasi (pembentukan himpunan fuzzy), 
                                                evaluasi rule, agregasi rule, dan defuzzifikasi (penegasan).</div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-tabs .tab');
            const panes = document.querySelectorAll('.tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(item => item.classList.remove('active'));
                    // Add active class to the clicked tab
                    this.classList.add('active');

                    // Hide all tab panes
                    panes.forEach(pane => pane.classList.remove('active'));
                    // Show the associated tab pane
                    const activePane = document.querySelector(`#${this.dataset.tab}`);
                    activePane.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>