<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Data Pembayaran MTs</h4>
        </div>
        <div class="card-body">
            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-control" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="0">Belum Bayar</option>
                        <option value="1">Menunggu Verifikasi</option>
                        <option value="2">Lunas</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabelPembayaran">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Gelombang</th>
                            <th>Tanggal Upload</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pembayaran as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_pendaftaran'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td>Gelombang <?= $row['gelombang'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row['tgl_upload'])) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['bukti_pembayaran'])) : ?>
                                        <a href="<?= base_url('bukti_pembayaran/' . $row['bukti_pembayaran']) ?>"
                                            class="btn btn-info btn-sm" target="_blank">
                                            <i class="fas fa-image"></i> Lihat
                                        </a>
                                    <?php else : ?>
                                        <span class="badge badge-secondary">Belum Upload</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status_pembayaran'] == 0) : ?>
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    <?php elseif ($row['status_pembayaran'] == 1) : ?>
                                        <span class="badge badge-info">Menunggu Verifikasi</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status_pembayaran'] == 1) : ?>
                                        <button onclick="verifikasiPembayaran(<?= $row['id_pembayaran'] ?>)"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Verifikasi
                                        </button>
                                        <button onclick="tolakPembayaran(<?= $row['id_pembayaran'] ?>)"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Tolak
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
        $('#tabelPembayaran').DataTable();

        // Filter handling
        $('#filterStatus').change(function() {
            var status = $(this).val();
            table.ajax.url('<?= base_url('Admin/getPembayaranMTs') ?>/' + status).load();
        });
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

    function tolakPembayaran(id) {
        Swal.fire({
            title: 'Tolak Pembayaran',
            text: "Masukkan alasan penolakan:",
            input: 'text',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Harap masukkan alasan penolakan!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('Admin/tolakPembayaran') ?>/' + id + '?alasan=' + result.value;
            }
        });
    }
</script>
<?= $this->endSection() ?>