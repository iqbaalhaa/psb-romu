<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Verifikasi Berkas MTs</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabelBerkas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Gelombang</th>
                            <th>KK</th>
                            <th>Akta</th>
                            <th>Ijazah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($berkas as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_pendaftaran'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td>Gelombang <?= $row['gelombang'] ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['kk'])) : ?>
                                        <a href="<?= base_url('berkas/' . $row['kk']) ?>"
                                            class="btn btn-info btn-sm" target="_blank">
                                            <i class="fas fa-file"></i> Lihat
                                        </a>
                                    <?php else : ?>
                                        <span class="badge badge-secondary">Belum Upload</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($row['akta'])) : ?>
                                        <a href="<?= base_url('berkas/' . $row['akta']) ?>"
                                            class="btn btn-info btn-sm" target="_blank">
                                            <i class="fas fa-file"></i> Lihat
                                        </a>
                                    <?php else : ?>
                                        <span class="badge badge-secondary">Belum Upload</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($row['ijazah'])) : ?>
                                        <a href="<?= base_url('berkas/' . $row['ijazah']) ?>"
                                            class="btn btn-info btn-sm" target="_blank">
                                            <i class="fas fa-file"></i> Lihat
                                        </a>
                                    <?php else : ?>
                                        <span class="badge badge-secondary">Belum Upload</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status_berkas'] == 1) : ?>
                                        <span class="badge badge-success">Lengkap</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Belum Lengkap</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status_berkas'] == 0 && !empty($row['kk']) && !empty($row['akta']) && !empty($row['ijazah'])) : ?>
                                        <button onclick="verifikasiBerkas(<?= $row['id_santri'] ?>)"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Verifikasi
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#tabelBerkas').DataTable();
    });

    function verifikasiBerkas(id) {
        Swal.fire({
            title: 'Verifikasi Berkas',
            text: "Apakah semua berkas sudah valid?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Verifikasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('Admin/verifikasiBerkas') ?>/' + id;
            }
        });
    }
</script>
<?= $this->endSection() ?>