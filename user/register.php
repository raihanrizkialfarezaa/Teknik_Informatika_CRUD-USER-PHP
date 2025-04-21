<?php
include "../services/database.php";

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = mysqli_real_escape_string($login, $_POST['nama']);
    $username = mysqli_real_escape_string($login, $_POST['username']);
    $email    = mysqli_real_escape_string($login, $_POST['email']);
    $password = md5(mysqli_real_escape_string($login, $_POST['password']));

    $cek = "SELECT id FROM users WHERE username='$username'";
    if (mysqli_num_rows(mysqli_query($login, $cek)) > 0) {
        $error = 'Username sudah terpakai';
    } else {
        $ins = "
          INSERT INTO users
            (nama_lengkap, username, email, password, role)
          VALUES
            ('$nama','$username','$email','$password','user')
        ";
        if (mysqli_query($login, $ins)) {
            header('Location: ../index.php?msg=Registrasi berhasil, silakan login');
            exit;
        } else {
            $error = 'Error: ' . mysqli_error($login);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register User</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/login/css/main.css">
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url('../assets/login/images/bg-01.jpg');">
                    <span class="login100-form-title-1">Register User</span>
                </div>
                <?php if ($error): ?>
                  <div class="alert alert-danger m-3"><?= $error ?></div>
                <?php endif ?>
                <form class="login100-form validate-form" method="POST" action="register.php">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nama lengkap dibutuhkan">
                        <span class="label-input100">Nama Lengkap</span>
                        <input class="input100" type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username dibutuhkan">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Masukkan username" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email dibutuhkan">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Masukkan email" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password dibutuhkan">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Masukkan password" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Register
                        </button>
                    </div>
                    <div class="text-cMasukkan p-t-115">
                        <a class="txt2" href="../index.php">
                            Sudah punya akun? Login di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>