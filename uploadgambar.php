<?php
//session login
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';
$gambar = query("SELECT * FROM gambar");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule || Update Gambar</title>
</head>
<body>
<a href="logout.php">Logout</a>
</<br>
    <h1>Gambar Profile</h1>
</br>
</br>
<a href="tambahgambar.php">Tambah gambar</a>
</br></br>
</br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
        </tr>
        <?php $i= 1 ; ?>
        <?php foreach($gambar as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><img src="img/<?=$row["gambar"]?>" alt="" width="60"></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>
</html>