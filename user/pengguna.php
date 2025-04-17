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
                                <th>Uername</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)): 
                                $u = $data[0]; ?>
                            <tr>
                                <td>1</td>
                                <td><?= htmlspecialchars($u['username']) ?></td>
                                <td><?= htmlspecialchars($u['nama_lengkap']) ?></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td align="center">
                                <a href="pengguna_edit.php?id=<?= $u['id'] ?>"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>
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
