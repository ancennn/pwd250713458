<?php
function dapatDiskon($totalBayar) {
    if ($totalBayar >= 60000) {
        return 0.2;
    } else {
        return 0;
    }
}

function totalHarga($diskon, $totalBayar) {
    return $totalBayar - ($totalBayar * $diskon);
}

$obat = $penyakit = "";
$errors = [];
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["obat"])) {
        $errors[] = "Obat tidak boleh kosong.";
    } else {
        $obat = $_POST["obat"];
    }

    if (empty($_POST["penyakit"])) {
        $errors[] = "Penyakit tidak boleh kosong.";
    } else {
        $penyakit = $_POST["penyakit"];
    }

    if (empty($errors)) {
        if ($penyakit == "lainnya") {
            $output .= "<p>Maaf, untuk penyakit lainnya silahkan konsultasikan dengan dokter.</p>";
        } else {
            $hargaObat = 0;
            if ($obat == "pil") {
                $hargaObat = 30000;
            } elseif ($obat == "tablet") {
                $hargaObat = 20000;
            } elseif ($obat == "sirup") {
                $hargaObat = 10000;
            }

            $hargaKategori = 0;
            if ($penyakit == "demam") {
                $hargaKategori = 40000;
            } elseif ($penyakit == "flu") {
                $hargaKategori = 30000;
            } elseif ($penyakit == "lainnya") {
                $hargaKategori = 0;
            }

            $totalBayar = $hargaObat + $hargaKategori;
            $diskon = dapatDiskon($totalBayar);
            $hargaAkhir = totalHarga($diskon, $totalBayar);

            $output .= "<h2>Informasi Belanja</h2>";
            $output .= "<p>Penyakit: " . htmlspecialchars($penyakit) . "</p>";
            $output .= "<p>Obat: " . htmlspecialchars($obat) . "</p>";
            $output .= "<p>Total Harga: Rp " . number_format($hargaAkhir, 0, ',', '.') . "</p>";
            $output .= "<p>Diskon: " . htmlspecialchars($diskon) . "</p>";

            if ($diskon == 0) {
                $output .= "<p>Maaf tidak ada diskon yang diberikan.</p>";
            } else {
                $output .= "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
            }
        }
    }
} else {
    $errors[] = "Silahkan pilih produk yang ingin dibeli.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Belanja - Daftar Stok</title>
</head>
<body>

    <h2>Belanja</h2>
    <h3>Daftar Stok</h3>

    <form action="" method="POST">
        <label for="obat">Obat:</label><br>
        <select id="obat" name="obat">
            <option value="">-- Pilih Obat --</option>
            <option value="pil" <?php if ($obat == "pil") echo "selected"; ?>>pil</option>
            <option value="tablet" <?php if ($obat == "tablet") echo "selected"; ?>>tablet</option>
            <option value="sirup" <?php if ($obat == "sirup") echo "selected"; ?>>sirup</option>
        </select><br><br>

        <label for="penyakit">Penyakit:</label><br>
        <select id="penyakit" name="penyakit">
            <option value="">-- Pilih Penyakit --</option>
            <option value="demam" <?php if ($penyakit == "demam") echo "selected"; ?>>demam</option>
            <option value="flu" <?php if ($penyakit == "flu") echo "selected"; ?>>flu</option>
            <option value="lainnya" <?php if ($penyakit == "lainnya") echo "selected"; ?>>lainnya</option>
        </select><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>

    <hr>

    <?php
    if (!empty($errors)) {
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo "</div>";
    } else {
        echo $output;
    }
    ?>

</body>
</html>