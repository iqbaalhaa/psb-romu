<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Data <?= $title ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambah">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
            </div>
        </div>
        <div class="card-body">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Foto</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($users as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center">
                                <img src="<?= base_url('foto/santri/' . $value['foto']) ?>" class="img-circle" width="50px" height="50px">
                            </td>
                            <td><?= $value['nama_user'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td class="text-center"><?= ucfirst($value['level']) ?></td>
                            <td class="text-center">
                                <?php if ($value['is_active'] == '1') { ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Non-Aktif</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_user'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_user'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('Admin/TambahUser') ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input name="nama_user" class="form-control" placeholder="Nama User" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($users as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Admin/EditUser/' . $value['id_user']) ?>
                    <div class="form-group">
                        <label>Nama User</label>
                        <input name="nama_user" class="form-control" value="<?= $value['nama_user'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $value['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control">
                            <option value="admin" <?= $value['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" <?= $value['is_active'] == '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $value['is_active'] == '0' ? 'selected' : '' ?>>Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Delete -->
<?php foreach ($users as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus user <b><?= $value['nama_user'] ?></b>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('Admin/HapusUser/' . $value['id_user']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
<?= $this->endSection() ?>