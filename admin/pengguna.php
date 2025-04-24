<?php
$title = 'pengguna';
require 'functions.php';
require '../layout/layout_header.php';
$query = 'SELECT * FROM `users`';
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
                        <a href="pengguna_tambah.php" class="btn btn-primary box-title"><i class="fa fa-plus fa-fw"></i> Tambah</a>
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
                            <?php foreach($data as $user): ?>
                                <tr>
                                    <td></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td><?= htmlspecialchars($user['nama_lengkap']) ?></td>
                                    <td>
                                        <img 
                                            src="../assets/profile/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>" 
                                            width="50" class="img-circle" 
                                            alt="Avatar">
                                    </td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td align="center">
                                        <a href="pengguna_edit.php?id=<?php echo $user['id']; ?>" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        &nbsp;
                                        <a href="pengguna_hapus.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
