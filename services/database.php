<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "informatika";

$login = mysqli_connect($hostname, $username, $password, $database);

echo "Berhasil terkoneksi database";
?>