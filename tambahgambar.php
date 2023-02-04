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
    if( tambahgambar($_POST) > 0 ){
        //cek apakah berhasil atau tidak 
        echo "<script>
            alert('Gambar Berhasil ditambah');
            document.location.href = 'uploadgambar.php';
            </script>
        ";

    } else {
        echo "<script>
        alert('Gambar Gagal ditambah');
        document.location.href = 'uploadgambar.php';
        </script>
    ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Schedule || Upload Gambar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body>
        <h1>Tambah Gambar</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <ul> 
                <li>
                    <label for="gambar">Gambar : </label>
                    <input type="file" id="gambar" name="gambar" >
                </li>
                <li>
                    <button type="submit" name="submit">Tambah</button>
                </li>
            </ul>
        </form>
    </body>
</html>