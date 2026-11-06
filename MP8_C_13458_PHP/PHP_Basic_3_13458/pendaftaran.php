<?php
$nama = $penyakit = $sesi = "";
$errors = [];
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nama"])) {
        $errors[] = "Nama tidak boleh kosong.";
    } else {
        $nama = trim($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
            $errors[] = "Nama hanya boleh mengandung huruf dan spasi.";
        }
    }

    if (empty($_POST["penyakit"])) {
        $errors[] = "Penyakit tidak boleh kosong.";
    } else {
        $penyakit = trim($_POST["penyakit"]);
    }

    if (empty($_POST["sesi"])) {
        $errors[] = "Sesi tidak boleh kosong.";
    } else {
        $sesi = trim($_POST["sesi"]);
    }

    $tempat = "";
    if ($sesi == "sesi 1") {
        $tempat = "Ruang dr. Jung di Lantai 3";
    } elseif ($sesi == "sesi 2") {
        $tempat = "Online Meeting (Zoom)";
    }

    if (empty($errors)) {
        $output .= "<h2>Informasi Pendaftaran</h2>";
        $output .= "<p>Nama: " . htmlspecialchars($nama) . "</p>";
        $output .= "<p>Penyakit: " . htmlspecialchars($penyakit) . "</p>";
        $output .= "<p>Sesi: " . htmlspecialchars($sesi) . "</p>";
        $output .= "<p>Tempat Konsultasi: " . htmlspecialchars($tempat) . "</p>";
        $output .= "<p>Anda mendaftar pada " . htmlspecialchars($sesi) . " di " . htmlspecialchars($tempat) . ". Silahkan hadir tepat waktu.</p>";
    }
} else {
    $errors[] = "Silahkan lengkapi formulir di atas.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Konsultasi</title>
</head>
<body>

    <h2>Pendaftaran Konsultasi</h2>
    <form action="" method="POST">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>"><br><br>

        <label for="penyakit">Penyakit:</label><br>
        <input type="text" id="penyakit" name="penyakit" value="<?php echo htmlspecialchars($penyakit); ?>"><br><br>

        <label for="sesi">Sesi:</label><br>
        <select id="sesi" name="sesi">
            <option value="">-- Pilih Sesi --</option>
            <option value="sesi 1" <?php if ($sesi == "sesi 1") echo "selected"; ?>>sesi 1</option>
            <option value="sesi 2" <?php if ($sesi == "sesi 2") echo "selected"; ?>>sesi 2</option>
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