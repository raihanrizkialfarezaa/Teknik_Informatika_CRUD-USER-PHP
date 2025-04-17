<?php
include "services/database.php";

if(isset($_POST["register"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    // echo $username . " " . $password;
    $regis = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if($login->query($regis)){
        echo "Sukses";
    } else {
        echo "Gagal";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "layout/header.html"?>

    <h3>Register</h3>

    <form action="register.php" method="POST">
        <p>Masukkan username <input type="text" name="username" id="username" placeholder="username"></p>
        <p>Masukkan password <input type="password" name="password" id="password" placeholder="password"></p>

        <button type="submit" name="register">Register</button>
    </form>

    <?php include "layout/footer.html"?>
</body>
</html>