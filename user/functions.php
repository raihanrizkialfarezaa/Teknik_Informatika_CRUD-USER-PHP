<?php 
session_start();
include "../services/database.php";

if($_SESSION){
    if($_SESSION['role'] == 'user'){

    }else{
        header('location:../index.php');
    }
}else{
    header('location:../index.php');
}

function ambildata($login,$query){
    $data = mysqli_query($login,$query);
    if (mysqli_num_rows($data) > 0) {
        while($row = mysqli_fetch_assoc($data)){
        $hasil[] = $row;
    }

    return $hasil;
    }
}

function bisa($login,$query){
    $db = mysqli_query($login,$query);

    if($db){
        return 1;
    }else{
        return 0;
    }
}

function ambilsatubaris($login,$query){
    $db = mysqli_query($login,$query);
    return mysqli_fetch_assoc($db);
}

function hapus($where,$table,$redirect){
    $query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
    echo $query;
}

?>