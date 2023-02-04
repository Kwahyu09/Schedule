<?php
//session login
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
//koneksi database
require 'functions.php';

$id = $_GET["id"];
$jadwal = query("SELECT * FROM jadwal WHERE id = $id")[0];

if( isset($_POST["submit"])){
    if( ubah($_POST) > 0 ){
    //cek apakah berhasil atau tidak diubah
        echo "<script>
            alert('Berhasil diubah');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "<script>
        alert('Gagal diubah');
        document.location.href = 'index.php';
        </script>
    ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Schedule || Ubah</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body>
        <h1>Ubah Data Schedule</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $jadwal["id"] ?>">
            <ul>
                <li>
                    <label for="tanggal">Tanggal : </label>
                    <input type="date" id="tanggal" name="tanggal" required value="<?= $jadwal["tanggal"] ?>">
                </li>
                <li>
                    <label for="hari">Hari : </label>
                    <input type="text" id="hari" name="hari" required value="<?= $jadwal["hari"] ?>">
                </li>
                <li>
                    <label for="jam">Jam : </label>
                    <input type="time" id="jam" name="jam" required value="<?= $jadwal["jam"] ?>">
                </li>
                <li>
                    <label for="keterangan">Keterangan : </label>
                    <input type="text" id="keterangan" name="keterangan" required value="<?= $jadwal["keterangan"] ?>">
                </li>
                <li>
                    <button type="submit" name="submit">Ubah</button>
                </li>
            </ul>
        </form>
    </body>
</html>