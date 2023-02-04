<?php 
require 'functions.php';
if(isset($_POST['register'])){
    if(registrasi($_POST) > 0 ){
        echo "<script>
        alert('Berhasil menambahkan user!');
        document.location.href = 'index.php';
        </script>
    ";
    }else{
    echo "<script>
            alert('Gagal menambahkan user !');
            document.location.href = 'index.php';
            </script>
    ";}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label{
            display: block;
        }
    </style>
</head>
<body>
    <h1 class="text-align:center">Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" id="username" name="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <label for="password1">Konfirmasi Pasword : </label>
                <input type="password" id="password1" name="password1">
            </li>
    </br>
            <li>
                <button type="submit" name="register">Registrasi</button>
            </li>
        </ul>
    </form>
</body>
</html>