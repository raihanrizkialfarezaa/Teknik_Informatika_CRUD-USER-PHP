<?php 
require 'functions.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID Pengguna tidak ditemukan!');location.href='pengguna.php';</script>";
    exit;
}
$id = $_GET['id'];

if (isset($_POST['btn-simpan'])) {
    $input = $_POST['passlama'];

    $querypass = "SELECT * FROM users WHERE role = 'admin' LIMIT 1";
    $res = mysqli_query($login, $querypass);
    $admin = mysqli_fetch_assoc($res);

    if (($input) !== $admin['password']) {
        echo "<script>alert('Password tidak sesuai');location.href='pengguna_hapus.php?id={$id}';</script>";
        exit;
    }

    $sql = "DELETE FROM users WHERE id = {$id}";
    if (mysqli_query($login, $sql)) {
        header("location: pengguna.php?crud=true&msg=Pengguna dihapus&type=success");
        exit;
    } else {
        echo "<script>alert('Gagal menghapus: ".mysqli_error($login)."');location.href='pengguna.php';</script>";
        exit;
    }
}
require '../layout/layout_header.php';
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Hapus Pengguna</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="pengguna.php">Pengguna</a></li>
                <li><a href="#">Hapus Pengguna</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title">
                            <i class="fa fa-arrow-left fa-fw"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Masukkan Password Admin untuk Menghapus!</label>
                        <input type="password" name="passlama" required class="form-control">
                    </div>
                    <div class="text-right">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="btn-simpan" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require '../layout/layout_footer.php';
?>

