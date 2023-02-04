<?php
//session login
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

//koneksi database
require 'functions.php';

if( isset($_POST["submit"])){
    if( tambah($_POST) > 0 ){
    //cek apakah berhasil atau tidak 
        echo "<script>
            alert('Berhasil ditambah');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "<script>
        alert('Gagal ditambah');
        document.location.href = 'index.php';
        </script>
    ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Schedule || Tambah</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <h1>Tambah Data Schedule</h1>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="tanggal">Tanggal : </label>
                <input type="date" id="tanggal" name="tanggal" required>
            </li>
            <li>
                <div class="div">
                    <label for="hari">Hari : </label>
                    <select id="hari" name="hari" required>
                        <option value="">--Pilih Hari--</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jum'at">Jum'at</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>
            </li>
            <li>
                <label for="jam">Jam : </label>
                <input type="time" id="jam" name="jam" required>
            </li>
            <li>
                <label for="keterangan">Keterangan : </label>
                <textarea id="keterangan" name="keterangan" required></textarea>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
    <script type="text/javascript">
    function contoh() {

        swal({

            title: "Berhasil!",

            text: "Pop-up berhasil ditampilkan",

            icon: "success",

            button: true

        });

    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

</body>

</html>