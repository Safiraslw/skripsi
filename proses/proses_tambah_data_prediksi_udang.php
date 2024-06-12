<?php
require "session.php";

$kode_produk        = $_POST['kode_produk'];
$nama_produk        = $_POST['nama_produk'];
$tanggal            = $_POST['periode'];
$permintaan         = $_POST['permintaan'];
$persediaan         = $_POST['persediaan'];
$produksi           = $_POST['produksi'];


$sql    = mysqli_query($conn, "INSERT INTO tabel_hasil (kode_produk, nama_produk, periode, permintaan, persediaan, produksi)
            VALUES ('$kode_produk','$nama_produk','$tanggal','$permintaan','$persediaan','$produksi')");

// Fungsi Keanggotaan untuk Pemesanan
function pemesananSedikit($permintaan)
{

    global $max_permintaan, $min_permintaan;

    if ($permintaan <= $min_permintaan) {
        return 1;
    } elseif ($permintaan > $min_permintaan && $permintaan < $max_permintaan) {
        return ($max_permintaan - $permintaan) / ($max_permintaan - $min_permintaan);
    } else {
        return 0;
    }
}

function pemesananBanyak($permintaan)
{

    global $max_permintaan, $min_permintaan;

    if ($permintaan <= $min_permintaan) {
        return 0;
    } elseif ($permintaan > $min_permintaan && $permintaan < $max_permintaan) {
        return ($permintaan - $min_permintaan) / ($max_permintaan - $min_permintaan);
    } else {
        return 1;
    }
}

// Fungsi Keanggotaan untuk Persediaan
function persediaanSedikit($persediaan)
{

    global $max_persediaan, $min_persediaan;

    if ($persediaan <= $min_persediaan) {
        return 1;
    } elseif ($persediaan > $min_persediaan && $persediaan < $max_persediaan) {
        return ($max_persediaan - $persediaan) / ($max_persediaan - $min_persediaan);
    } else {
        return 0;
    }
}

function persediaanBanyak($persediaan)
{

    global $max_persediaan, $min_persediaan;

    if ($persediaan <= $min_persediaan) {
        return 0;
    } elseif ($persediaan > $min_persediaan && $persediaan < $max_persediaan) {
        return ($persediaan - $min_persediaan) / ($max_persediaan - $min_persediaan);
    } else {
        return 1;
    }
}

function evaluateRules($permintaan, $persediaan)
{
    $rules = [];

    $rules[] = min(pemesananBanyak($permintaan), persediaanBanyak($persediaan)); // Rule 1
    $rules[] = min(pemesananBanyak($permintaan), persediaanSedikit($persediaan)); // Rule 2
    $rules[] = min(pemesananSedikit($permintaan), persediaanBanyak($persediaan)); // Rule 3
    $rules[] = min(pemesananSedikit($permintaan), persediaanSedikit($persediaan)); // Rule 4

    return $rules;
}


// Defuzzifikasi (Centroid Method)
function defuzzification($rules)
{
    if (!is_array($rules) || empty($rules)) {
        return 0; // Nilai default jika $rules bukan array atau kosong
    } else {
        $rule = min($rules); // Menggunakan metode MIN untuk evaluasi rule
        $aggregated_rule = max($rules); // Menggunakan metode MAX untuk agregasi rule 
    }

    global $max_produksi, $min_produksi;
    $min_output = $min_produksi;
    $max_output = $max_produksi;

    $batas1 = (($max_output - $min_output) * $rule) + $min_output; //batas area1
    $batas2 = (($max_output - $min_output) * $aggregated_rule) + $min_output; //batas area2

    $momen1 = ($rule / 2) * ($batas1 ** 2);
    $momen2 = ((((1 / ($max_output - $min_output)) / 3) * ($batas2 ** 3) - ($min_output / ($max_output - $min_output) / 2) * ($batas2 ** 2)) - (((1 / ($max_output - $min_output)) / 3) * ($batas1 ** 3) - ($min_output / ($max_output - $min_output) / 2) * ($batas1 ** 2)));
    $momen3 = (($aggregated_rule / 2 * ($max_output ** 2)) - ($aggregated_rule / 2 * ($batas2 ** 2)));

    $A1 = ($batas1 * $rule); //luas area1
    $A2 = (($rule + $aggregated_rule) * (($batas2 - $batas1) / 2)); //luas area2
    $A3 = (($max_output - $batas2) * $aggregated_rule); //luas area3

    $centroid = ($momen1 + $momen2 + $momen3) / ($A1 + $A2 + $A3);

    return $centroid;
}

// Ambil nilai maksimum dan minimum dari permintaan, persediaan, dan produksi
$query = "SELECT MAX(permintaan) as max_permintaan, MIN(permintaan) as min_permintaan, 
            MAX(persediaan) as max_persediaan, MIN(persediaan) as min_persediaan, 
            MAX(produksi) as max_produksi, MIN(produksi) as min_produksi
            FROM data_training WHERE kode_produk= 'B01'";

$result = mysqli_query($conn, $query);
$range = mysqli_fetch_assoc($result);

// Menampilkan nilai maksimum dan minimum
$max_permintaan = $range['max_permintaan'];
$min_permintaan = $range['min_permintaan'];
$max_persediaan = $range['max_persediaan'];
$min_persediaan = $range['min_persediaan'];
$max_produksi = $range['max_produksi'];
$min_produksi = $range['min_produksi'];

// echo "max = $max_permintaan <br>";
// echo "min = $min_permintaan <br>";
// echo "max = $max_persediaan <br>";
// echo "min = $min_persediaan <br>";
// echo "max = $max_produksi <br>";
// echo "min = $min_produksi <br>";

$tampil_data = mysqli_query($conn, "SELECT * FROM tabel_hasil WHERE kode_produk = 'B01'");

while ($r = mysqli_fetch_array($tampil_data)) {
    $id_hasil = $r['id_hasil'];
    $permintaan = $r['permintaan'];
    $persediaan = $r['persediaan'];

    $rules = evaluateRules($permintaan, $persediaan);
    // $agregasi = aggregateRules($rules);
    $hasil = round(defuzzification($rules));

    $update = mysqli_query($conn, "UPDATE tabel_hasil SET hasil='$hasil' WHERE id_hasil='$id_hasil'");
    if ($update) {
        echo "<script>alert('Data prediksi berhasil ditambah')</script>";
        echo "<script>window.location='../prediksi_udang.php';</script>";
    } else {
        echo "<script>alert('Data prediksi tidak berhasil ditambah')</script>";
        echo "<script>window.location='../tambah_dataprediksiudang.php';</script>";
    }
}

?>