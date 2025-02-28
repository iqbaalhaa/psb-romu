<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Data Pendaftar MTs</h4>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Filter Tahun Ajaran -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-control" id="filterTahun">
                        <option value="">Semua Tahun Ajaran</option>
                        <?php foreach ($tahun_ajaran ?? [] as $ta) : ?>
                            <option value="<?= $ta['tahun_ajaran'] ?>"><?= $ta['tahun_ajaran'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" id="filterGelombang">
                        <option value="">Semua Gelombang</option>
                        <option value="1">Gelombang 1</option>
                        <option value="2">Gelombang 2</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabelPendaftar">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Gelombang</th>
                            <th>Status Pembayaran</th>
                            <th>Status Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pendaftar as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_pendaftaran'] ?></td>
                                <td><?= $row['nisn'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td>Gelombang <?= $row['gelombang'] ?></td>
                                <td>
                                    <?php if ($row['status_pembayaran'] == 2) : ?>
                                        <span class="badge badge-success">Lunas</span>
                                    <?php elseif ($row['status_pembayaran'] == 1) : ?>
                                        <span class="badge badge-info">Menunggu Verifikasi</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['status_berkas'] == 1) : ?>
                                        <span class="badge badge-success">Lengkap</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Belum Lengkap</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('Admin/DetailPendaftar/' . $row['id_santri']) ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <?php if ($row['status_pembayaran'] == 1) : ?>
                                        <button onclick="verifikasiPembayaran(<?= $row['id_pembayaran'] ?>)" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Verifikasi
                                        </button>
                                    <?php endif; ?>
                                    
                                    <!-- Tambahkan tombol Edit dan Hapus -->
                                    <a href="<?= base_url('Admin/EditPendaftar/' . $row['id_santri']) ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button onclick="hapusPendaftar(<?= $row['id_santri'] ?>)" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
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
        $('#tabelPendaftar').DataTable();
    });

    function verifikasiPembayaran(id) {
        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: "Apakah pembayaran ini sudah valid?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Verifikasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('Admin/verifikasiPembayaran') ?>/' + id;
            }
        });
    }

    function hapusPendaftar(id) {
        Swal.fire({
            title: 'Hapus Data Pendaftar',
            text: "Apakah Anda yakin ingin menghapus data pendaftar ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('Admin/HapusPendaftar') ?>/' + id;
            }
        });
    }
</script>
<?= $this->endSection() ?>