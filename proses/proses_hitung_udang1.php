<?php

// Fungsi Keanggotaan untuk Pemesanan
function pemesananSedikit($permintaan)
{
    if ($permintaan <= 62) {
        return 1;
    } elseif ($permintaan > 62 && $permintaan < 300) {
        return (300 - $permintaan) / (300 - 62);
    } else {
        return 0;
    }
}

function pemesananBanyak($permintaan)
{
    if ($permintaan <= 62) {
        return 0;
    } elseif ($permintaan > 62 && $permintaan < 300) {
        return ($permintaan - 62) / (300 - 62);
    } else {
        return 1;
    }
}

// Fungsi Keanggotaan untuk Persediaan
function persediaanSedikit($persediaan)
{
    if ($persediaan <= 10) {
        return 1;
    } elseif ($persediaan > 10 && $persediaan < 80) {
        return (80 - $persediaan) / (80 - 10);
    } else {
        return 0;
    }
}

function persediaanBanyak($persediaan)
{
    if ($persediaan <= 10) {
        return 0;
    } elseif ($persediaan > 10 && $persediaan < 80) {
        return ($persediaan - 10) / (80 - 10);
    } else {
        return 1;
    }
}

// Rule Evaluation
function evaluateRules($permintaan, $persediaan)
{
    $rules = [];

    $rules[] = min(pemesananBanyak($permintaan), persediaanBanyak($persediaan));
    $rules[] = min(pemesananBanyak($permintaan), persediaanSedikit($persediaan));
    $rules[] = min(pemesananSedikit($permintaan), persediaanBanyak($persediaan));
    $rules[] = min(pemesananSedikit($permintaan), persediaanSedikit($persediaan));

    return $rules;
}

// Rule Aggregation
function aggregateRules($rules)
{
    $aggregated_rule = max($rules); // Menggunakan metode MAX sebagai agregasi aturan fuzzy

    return $aggregated_rule;
}

// Defuzzifikasi (Centroid Method)
function defuzzification($rules)
{
    $numerator = 0;
    $denominator = 0;

    for ($i = 0; $i < count($rules); $i++) {
        $numerator += ($i * 270 + 23) * $rules[$i]; 
        $denominator += $rules[$i];                 
    }

    if ($denominator == 0) return 0;

    return $numerator / $denominator;
}

include "koneksi.php";

$tampil_data = mysqli_query($conn, "SELECT * FROM tabel_hasil");

while ($r = mysqli_fetch_array($tampil_data)) {
    $id_hasil = $r['id_hasil'];
    $permintaan = $r['permintaan'];
    $persediaan = $r['persediaan'];

    $rules = evaluateRules($permintaan, $persediaan);
    $aggregated_rule = aggregateRules($rules); // Menghitung agregasi aturan fuzzy
    $hasil = defuzzification($aggregated_rule);

    $update = mysqli_query($conn, "UPDATE tabel_hasil SET hasil='$hasil' WHERE id_hasil='$id_hasil'");
    if ($update) {
        echo "<script>alert('Data berhasil diperbaharui')</script>";
        echo "<script>window.location='../prediksi_udang.php';</script>";
    } else {
        echo "<script>alert('Data tidak berhasil diperbaharui')</script>";
        echo "<script>window.location='../prediksi_udang.php';</script>";
    }
}



// Fungsi Keanggotaan untuk Pemesanan
// function pemesananSedikit($permintaan)
// {
//     if ($permintaan <= 62) {
//         return 1;
//     } elseif ($permintaan > 62 && $permintaan < 300) {
//         return (300 - $permintaan) / (300 - 62);
//     } else {
//         return 0;
//     }
// }

// function pemesananBanyak($permintaan)
// {
//     if ($permintaan <= 62) {
//         return 0;
//     } elseif ($permintaan > 62 && $permintaan < 300) {
//         return ($permintaan - 62) / (300 - 62);
//     } else {
//         return 1;
//     }
// }

// // Fungsi Keanggotaan untuk Persediaan
// function persediaanSedikit($persediaan)
// {
//     if ($persediaan <= 10) {
//         return 1;
//     } elseif ($persediaan > 10 && $persediaan < 80) {
//         return (80 - $persediaan) / (80 - 10);
//     } else {
//         return 0;
//     }
// }

// function persediaanBanyak($persediaan)
// {
//     if ($persediaan <= 10) {
//         return 0;
//     } elseif ($persediaan > 10 && $persediaan < 80) {
//         return ($persediaan - 10) / (80 - 10);
//     } else {
//         return 1;
//     }
// }

// // Rule Evaluation
// function evaluateRules($permintaan, $persediaan)
// {
//     $rules = [];

//     $rules[] = min(pemesananBanyak($permintaan), persediaanBanyak($persediaan));
//     $rules[] = min(pemesananBanyak($permintaan), persediaanSedikit($persediaan));
//     $rules[] = min(pemesananSedikit($permintaan), persediaanBanyak($persediaan));
//     $rules[] = min(pemesananSedikit($permintaan), persediaanSedikit($persediaan));

//     return $rules;
// }

// // Defuzzifikasi (Centroid Method)
// function defuzzification($rules)
// {
//     $numerator = 0;
//     $denominator = 0;

//     for ($i = 0; $i < count($rules); $i++) {
//         $numerator += ($i * 270 + 23) * $rules[$i]; // nilai 270 merupakan nilai produksi terbanyak dan 23 nilai produksi terkecil
//         $denominator += $rules[$i];                 // dari tabel data training
//     }

//     if ($denominator == 0) return 0;

//     return $numerator / $denominator;
// }

// include "koneksi.php";

// $tampil_data = mysqli_query($conn, "SELECT * FROM tabel_hasil");

// while ($r = mysqli_fetch_array($tampil_data)) {
//     $id_hasil = $r['id_hasil'];
//     $permintaan = $r['permintaan'];
//     $persediaan = $r['persediaan'];

//     $rules = evaluateRules($permintaan, $persediaan);
//     $hasil = defuzzification($rules);

//     $update = mysqli_query($conn, "UPDATE tabel_hasil SET hasil='$hasil' WHERE id_hasil='$id_hasil'");
//     if ($update) {
//         echo "<script>alert('Data berhasil diperbaharui')</script>";
//         echo "<script>window.location='../prediksi_udang.php';</script>";
//     } else {
//         echo "<script>alert('Data tidak berhasil diperbaharui')</script>";
//         echo "<script>window.location='../prediksi_udang.php';</script>";
//     }
// }


// Defuzzifikasi (Centroid Method)
// function defuzzification($rules, $aggregated_rule)
// {

    

//     $batas1 = ((250 - 23) * $rules) + 23;
//     $batas2 = ((250 - 23) * $aggregated_rule) + 23;

//     $momen1 = ($rules / 2) * ($batas1 ^ 2);
//     $momen2 = ((((1 / (250 - 23)) / 3) * ($batas2 ^ 3) - (23 / (250 - 23) / 2) * ($batas2 ^ 2)) - (((1 / (250 - 23)) / 3) * ($batas1 ^ 3) - (23 / (250 - 23) / 2) * ($batas1 ^ 2)));
//     $momen3 = (($aggregated_rule / 2 * (250 ^ 2)) - ($aggregated_rule / 2 * ($batas2 ^ 2)));

//     $A1 = ($batas1 * $rules);
//     $A2 = (($rules + $aggregated_rule) * (($batas2 - $batas1) / 2));
//     $A3 = ((250 - $batas2) * $aggregated_rule);

//     $centroid = (($momen1 + $momen2 + $momen3) / ($A1 + $A2 + $A3));

//     return $centroid;
// }