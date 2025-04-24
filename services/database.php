<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "native";

$login = mysqli_connect($hostname, $username, $password, $database);

echo "Berhasil terkoneksi database";
?>