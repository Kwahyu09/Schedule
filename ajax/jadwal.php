<?php 
usleep(250000);
require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM jadwal WHERE tanggal LIKE '%$keyword%' OR
    hari LIKE '%$keyword%' OR jam LIKE '%$keyword%' OR keterangan LIKE '%$keyword%'";
$jadwal = query($query);
?>
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