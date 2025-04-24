<?php
session_start();
include "../services/database.php"; 

if($_SESSION){
    if($_SESSION['role'] == 'admin'){

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

function uploadImage($file){
    $target_dir = "../assets/profile/";
    if(!is_dir($target_dir)) mkdir($target_dir, 0755, true);
    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $allow = ['jpg','jpeg','png','gif'];
    if(!in_array($ext, $allow)) return false;
    $newName = time()."_".uniqid().".{$ext}";
    $target = $target_dir . $newName;
    if(getimagesize($file["tmp_name"]) && move_uploaded_file($file["tmp_name"], $target)){
        return $newName;
    }
    return false;
}

?>