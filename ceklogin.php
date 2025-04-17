<?php
session_start();
include "services/database.php";
// die(mysqli_error($conn));

$username = ($_POST['username']);
$password = ($_POST['password']);
$query = "SELECT * FROM users where username='$username' AND password = '$password'";
$row = mysqli_query($login,$query);
$data = mysqli_fetch_assoc($row);
$cek = mysqli_num_rows($row);

if($cek > 0){
    if($data['role'] == 'admin'){
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['user_id'] = $data['id'];
        header('Location: /teknik_informatika/admin/pengguna.php');
        exit;

    }else if($data['role'] == 'user'){
        $_SESSION['role'] = 'user';
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['user_id'] = $data['id'];
        header('Location: /teknik_informatika/user/pengguna.php');
        exit;
    }
}else{
    $msg = 'Username Atau Password Anda Salah';
    header('location:index.php?msg='.$msg);
}
