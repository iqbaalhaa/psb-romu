<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Data <?= $title ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambah">
                    <i class="fas fa-plus"></i> Tambah
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

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Jurusan</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($jurusan as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['nama_jurusan'] ?></td>
                            <td class="text-center"><?= $value['kuota'] ?></td>
                            <td class="text-center">
                                <?php if ($value['is_active'] == '1') { ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Non-Aktif</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_jurusan'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_jurusan'] ?>">
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
                <h4 class="modal-title">Tambah Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('Admin/TambahJurusan') ?>
                <div class="form-group">
                    <label>Nama Jurusan</label>
                    <input name="nama_jurusan" class="form-control" placeholder="Nama Jurusan" required>
                </div>
                <div class="form-group">
                    <label>Kuota</label>
                    <input type="number" name="kuota" class="form-control" placeholder="Kuota" required>
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
<?php foreach ($jurusan as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_jurusan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Jurusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Admin/EditJurusan/' . $value['id_jurusan']) ?>
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <input name="nama_jurusan" class="form-control" value="<?= $value['nama_jurusan'] ?>" placeholder="Nama Jurusan" required>
                    </div>
                    <div class="form-group">
                        <label>Kuota</label>
                        <input type="number" name="kuota" class="form-control" value="<?= $value['kuota'] ?>" placeholder="Kuota" required>
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
<?php foreach ($jurusan as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_jurusan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Jurusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus jurusan <b><?= $value['nama_jurusan'] ?></b>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('Admin/HapusJurusan/' . $value['id_jurusan']) ?>" class="btn btn-danger btn-sm">Hapus</a>
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