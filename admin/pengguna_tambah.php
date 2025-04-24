<?php
$title = 'pengguna';
require 'functions.php';
$roles = ['admin','user'];

if (isset($_POST['btn-simpan'])) {
    $nama     = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $pass     = md5($_POST['password']);
    $email    = $_POST['email'];  
    $role     = $_POST['role'];

    $avatarToSave = null;
        if (!empty($_FILES['avatar']['name'])) {
            $up = uploadImage($_FILES['avatar']);
            $avatarToSave = $up ?: null;
        }

        $query = "
        INSERT INTO users 
          (nama_lengkap, username, password, email, role, avatar) 
        VALUES 
          ('$nama', '$username', '$pass', '$email', '$role', ".($avatarToSave? "'$avatarToSave'" : "NULL").")
      ";

    if (bisa($login, $query) == 1) {
        header('Location: pengguna.php?crud=true&msg=Berhasil menambahkan '.$role);
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal menambahkan data</div>";
    }
}

require '../layout/layout_header.php';
?>
<div class="container-fluid">
  <h3>Tambah Pengguna</h3>
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama_lengkap" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Role</label>
      <select name="role" class="form-control" required>
        <?php foreach($roles as $r): ?>
          <option value="<?= $r ?>"><?= ucfirst($r) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
        <label>Foto Profil</label>
        <input type="file" name="avatar" class="form-control">
    </div>
    <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
    <a href="pengguna.php" class="btn btn-default">Batal</a>
  </form>
</div>
<?php require '../layout/layout_footer.php'; ?>