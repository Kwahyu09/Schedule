<?php
//session login
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
//koneksi kedatabase
//memanggil file lain menggunakan require
require 'functions.php';

//pagination (membatasi halaman yang tampil)
//konfigurasi
// $datadihalaman = 2;
// $jumlahdata = count(query("SELECT * FROM jadwal"));
// $jumlahhalaman = ceil($jumlahdata / $datadihalaman);
// // if( isset($_GET["halaman"])){
// //     $halamanAktif = $_GET["halaman"];
// // } else {
// //     $halamanAktif = 1;
// // }
// //kondisi yang lebih elegan sama seperti yang diatas
// $halamanAktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1 ;
// $awaldata = ($datadihalaman * $halamanAktif) - $datadihalaman;
// //round adalah membulatkan pecahan ke bilangan terdekatnya
//floor adalah membulatkan pecahan ke bilangan kecilnya
//ceil adalah membulatkan pecahan ke bilangan bilangan besar
//mengembalikan objek 
// $result = mysqli_query($conn, " SELECT * FROM jadwal ");
// $jumlahdata = mysqli_num_rows($result);
// //ambil data dari tabel jadwal
// $jadwal = query("SELECT * FROM jadwal ORDER BY hari DESC");
$jadwal = query("SELECT * FROM jadwal ORDER BY hari DESC");
// $jadwal = query("SELECT * FROM jadwal LIMIT $awaldata, $datadihalaman");
//TAMPILKAN DATA DARI INDEK 1 DENGAN JUMLAH 2 DATA selanjutnya setelah limit


if( isset($_POST["cari"])){
    $jadwal = cari($_POST["keyword"]);
}
//ambil data dari array fetch jadwal dari result 
//mysqli_fetch_row() => mengembalikan array numerik    var_dump($jadwal[4]);
//mysqli_fetch_assoc() => mengembalikan array assoc var_dump($jadwal["nama"]);
//mysqli_fetch_array() => mengembalikan array numerik atau assoc kekurangan data tampil double
//mysqli_fetch_object() => menggunakan object var_dump($jadwal->nama);
// while($jadwal = mysqli_fetch_assoc($result)){
// var_dump($jadwal);
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Schedule</title>
    <style>
        .loader{
            width: 100px;
            position: absolute;
            top: 193px;
            left: 280px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <a href="logout.php">Logout</a> || <a href="cetak.php" target="_blank">Cetak</a>
    </br>
    <h1>Daftar Jadwal</h1>
    </br>
    </br>
    <a href="tambah.php">Tambah Schedule</a>
    </br>
    </br>
    <a href="uploadgambar.php">Upload Gambar</a>
    </br></br>
    <form action="" method="post">

        <input type="text" name="keyword" size="40" placeholder="Cari data...." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
        <img src="img/Loading_icon.gif" class="loader" alt="">

    </form>
    </br>
    <!-- navigasi -->
    <!-- <?php if( $halamanAktif > 1) : ?>
        <a href="?halaman=<?=$halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>
    <?php for( $i = 1; $i <= $jumlahhalaman ; $i++) :  ?>
        <?php if( $i == $halamanAktif ) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color : green"><?= $i ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if( $halamanAktif < $jumlahhalaman) : ?>
        <a href="?halaman=<?=$halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?> -->
    </br>

    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Hari</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php $i= 1 ; ?>
        <?php foreach($jadwal as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["hari"] ?></td>
            <td><?= $row["tanggal"] ?></td>
            <td><?= $row["jam"] ?></td>
            <td><?= $row["keterangan"] ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> ||
                <a href="hapus.php?id=<?= $row["id"]; ?>"
                    onclick="return confirm('Yakin Menghapus Data ini?');">Hapus</a>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html>