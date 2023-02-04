<?php 

$conn = mysqli_connect("localhost", "root","","schedule_db");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    //ambil data tiap elemen
    $tanggal = htmlspecialchars($data["tanggal"]);
    $hari = htmlspecialchars($data["hari"]);
    $jam = htmlspecialchars($data["jam"]);
    $keterangan = htmlspecialchars($data["keterangan"]);

    $query = "INSERT INTO jadwal VALUES('', '$tanggal', '$hari' , '$jam', '$keterangan')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function tambahgambar($data){
    global $conn;

    $gambar = upload();
    //cek gambar 
    if (!$gambar){
        return false;
    }

    $query = "INSERT INTO gambar VALUES('', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function upload(){
    $namaFile = $_FILES['gambar']['name']; 
    $ukuranFile = $_FILES['gambar']['size']; 
    $error = $_FILES['gambar']['error']; 
    $tampName = $_FILES['gambar']['tmp_name']; 

    if($error === 4){
        echo "<script>
            alert('Gambar tidak boleh kosong');
            document.location.href = 'uploadgambar.php';
            </script>
        ";
        return false;
    }

    //cek upload hanya gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
            alert('Gunakan gambar jenis Jpg, Jpeg, atau Png');
            document.location.href = 'uploadgambar.php';
            </script>
        ";
        return false;
    }

    //cek jika ukurannya terlalu besar
    // if($ukuranFile > 1000000){
    //     echo "<script>
    //         alert('ukuran file hanya 2 mb');
    //         document.location.href = 'uploadgambar.php';
    //         </script>
    //     ";
    //     return false;
    // }

    //lolos pengecekan gambar bisa diupload
    //generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tampName, 'img/'. $namaFileBaru);
    return $namaFileBaru;

}


function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM jadwal WHERE id=$id");
    return mysqli_affected_rows($conn);
}


function ubah($data){
    global $conn;
    //ambil data tiap elemen
    $id = $data["id"];
    $tanggal = $data["tanggal"];
    $hari = $data["hari"];
    $jam = $data["jam"];
    $keterangan = htmlspecialchars($data["keterangan"]);

    $query = "UPDATE jadwal SET
        tanggal = '$tanggal',
        hari = '$hari',
        jam = '$jam',
        keterangan = '$keterangan' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function cari($keyword){
    $query = "SELECT * FROM jadwal WHERE tanggal LIKE '%$keyword%' OR
    hari LIKE '%$keyword%' OR jam LIKE '%$keyword%' OR keterangan LIKE '%$keyword%'";
    return query($query);
}

function registrasi($data){
    global $conn;
    //strrolower untuk huruf kecil semua
    //striplashes untuk menghilangkan garis bawah yg dimasukan ke database
    //htmlspecial untuk mencehgah user mamsukan scrip yang merusak sistem
    $username = strtolower(stripslashes(htmlspecialchars($data["username"])));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password1 = mysqli_real_escape_string($conn, $data["password1"]);

    //cek username apakah sudah ada didatabese
    $result = mysqli_query($conn, "SELECT username FROM user_tb WHERE username='$username' ");
    if(mysqli_fetch_row($result)){
        echo "<script>
                alert('Username Sudah Terdaftar');
                document.location.href = 'registrasi.php';
                </script>
            ";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password1){
        echo "<script>
                alert('Konfirmasi Password tidak sesuai !');
                document.location.href = 'registrasi.php';
                </script>
            ";
        return false;
    }

    //enkripsi dulu password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //insert ke database
    mysqli_query($conn, "INSERT INTO user_tb VALUES('','$username', '$password')");
    return mysqli_affected_rows($conn);

}
?>