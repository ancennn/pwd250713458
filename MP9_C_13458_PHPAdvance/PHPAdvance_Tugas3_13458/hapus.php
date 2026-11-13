<?php
    require 'koneksi.php';

    $ID = $_GET['id'] ?? '';

    if ($ID === '' || !ctype_digit($ID)) {
        echo "<p style = 'color : red';>!! ID tidak valid. !!</p>";
    } else {
        $Delete = 'DELETE FROM menu WHERE id = ?';
        $Result = mysqli_prepare ($conn, $Delete);
        mysqli_stmt_bind_param($Result, 'i', $ID);
        mysqli_stmt_execute($Result); 

        if (mysqli_stmt_affected_rows($Result) === 1) {
            echo "Data berhasil dihapus";
        } else {
            echo "Data tidak ditemukan";
        }
    }

    echo '<a href = "index.php">Kembali</a>';
?> 