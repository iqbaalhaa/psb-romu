<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data Tahun Ajaran</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="tabelTahunAjaran" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tahun_ajaran as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['tahun_ajaran'] ?></td>
                            <td class="text-center">
                                <?php if ($value['is_active'] == '1') : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $value['id_tahun'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="hapus(<?= $value['id_tahun'] ?>)">
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
<div class="modal fade" id="tambahModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/TambahTahunAjaran') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" class="form-control" name="tahun_ajaran" placeholder="2024/2025" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($tahun_ajaran as $value) : ?>
    <div class="modal fade" id="editModal<?= $value['id_tahun'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Tahun Ajaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Admin/EditTahunAjaran/' . $value['id_tahun']) ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" class="form-control" name="tahun_ajaran" value="<?= $value['tahun_ajaran'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control" required>
                                <option value="1" <?= $value['is_active'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $value['is_active'] == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#tabelTahunAjaran').DataTable();
    });

    function hapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('Admin/HapusTahunAjaran') ?>/" + id;
            }
        })
    }
</script>
<?= $this->endSection() ?>