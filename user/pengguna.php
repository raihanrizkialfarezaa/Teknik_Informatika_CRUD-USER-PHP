<?php
session_start();
$title = 'pengguna';
require 'functions.php';
require '../layout/layout_header.php';
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$userId'";
$data = ambildata($login,$query);
// die($data);
?> 
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Pengguna</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Pengguna</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Avatar</th>
                                <th>Email</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)): foreach($data as $user): ?>
                            <tr>
                                <td></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['nama_lengkap']) ?></td>
                                <td>
                                    <img 
                                        src="../assets/profile/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>" 
                                        width="50" height="50"
                                        style="object-fit: cover;"
                                        class="img-thumbnail"
                                        alt="Avatar">
                                </td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td align="center">
                                    <a href="pengguna_edit.php?id=<?= $user['id'] ?>"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
</div>
<?php
require'../layout/layout_footer.php';
?>
