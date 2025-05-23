<?php
$title = 'pengguna';
require'functions.php';

$role = ['admin','user'];

$id_user = $_GET['id'];
$queryedit = "SELECT * FROM users WHERE id = '$id_user'";
$edit = ambilsatubaris($login,$queryedit);

if(isset($_POST['btn-simpan'])){
    $nama = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $passwordlam = $_POST['passlama'];
    $querypass = "SELECT * FROM users WHERE id = '$id_user'";
    $res = mysqli_query($login, $querypass);
    $old = mysqli_fetch_assoc($res);
    $email_lama = $old['email'];
    $profil = ambilsatubaris($login,"SELECT avatar FROM users WHERE id='$id_user'");

    if (!empty($_FILES['avatar']['name'])) {
        $up = uploadImage($_FILES['avatar']);
        $avatarToSave = $up ?: $profil['avatar'];
    } else {
        $avatarToSave = $profil['avatar'];
    }

    if (md5($_POST['passlama']) !== $old['password']) {
        echo "<script>alert('Password lama tidak sesuai');location.href='pengguna_edit.php?id=$id_user';</script>";
        exit;
    }
    if (!empty($_POST['password'])) {
        $passwordToSave = md5(mysqli_real_escape_string($login, $_POST['password']));
    } else {
        $passwordToSave = $old['password'];
    }

    if(!empty(trim($_POST['email']))){
        $emailToSave = $email;
    } else {
        $emailToSave = $email_lama;
    }

    $query = "
          UPDATE users SET
            nama_lengkap='$nama',
            username='$username',
            email='$emailToSave',
            role='$role',
            password='$passwordToSave',
            avatar='$avatarToSave'
          WHERE id='$id_user'
        ";
    
    $execute = bisa($login,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah ' .$role;
        $type = 'success';
        header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}

require'../layout/layout_header.php';
?> 
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Pengguna</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Pengguna</a></li>
                <li><a href="#">Tambah Pengguna</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                          <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $edit['nama_lengkap'] ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $edit['username'] ?>">
                </div>
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="text" name="passlama" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="text" name="password" class="form-control">
                    <small class="text-danger">Kosongkan saja jika tidak akan mengubah password</small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?= $edit['email'] ?>">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="admin" <?= $edit['role'] === 'admin' ? 'selected' : '' ?>>
                            Admin
                        </option>
                        <option value="user" <?= $edit['role'] === 'user' ? 'selected' : '' ?>>
                            User
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" name="avatar" class="form-control">
                    <?php if($edit['avatar']): ?>
                    <img src="../assets/profile/<?= $edit['avatar'] ?>" width="100" class="m-t-10">
                    <?php endif ?>
                </div>
                <div class="text-right">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require'../layout/layout_footer.php';
?>