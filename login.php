<?php 
session_start();
require 'functions.php';

//cek cookie sistem
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user_tb WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    
    //cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"])){
    header("Location:index.php");
    exit;
}
if(isset($_POST["login"])){  
    $username = $_POST["username"];
    $password = $_POST["password"];

    //mengambil nilai username yang ada didatabase
    $result = mysqli_query($conn, "SELECT * FROM user_tb WHERE username = '$username'");
    
    //cek usernamenya
    if( mysqli_num_rows($result) === 1 ){
        //cek lagi passwordnya kalau ada usernamenya
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ){
            //jalankan session
            $_SESSION["login"] = true;

            //cek remember me
            if(isset($_POST["remember"])){
                // //buat cookie
                setcookie('key', hash('sha256', $row['username'],time()+60));
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1 class="text-align:center">Login</h1>
    <?php if(isset($error)) : ?>
    <p style="color: red; font-style:italic">Username / Password Salah</p>
    <?php endif; ?>
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
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me </label>
            </li>
            </br>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>

</html>