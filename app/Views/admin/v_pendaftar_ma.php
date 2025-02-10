<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Data Pendaftar MA</h4>
        </div>
        <div class="card-body">
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
                                        <button onclick="tolakPembayaran(<?= $row['id_pembayaran'] ?>)" class="btn btn-danger btn-sm">
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
    // Inisialisasi DataTable
    var table = $('#tabelPendaftar').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    });

    // Filter Tahun Ajaran
    $('#filterTahun').on('change', function() {
        table.column(1).search(this.value).draw();
    });

    // Filter Gelombang
    $('#filterGelombang').on('change', function() {
        table.column(4).search(this.value ? 'Gelombang ' + this.value : '').draw();
    });
});

// Fungsi verifikasi pembayaran
function verifikasiPembayaran(id_pembayaran) {
    Swal.fire({
        title: 'Verifikasi Pembayaran',
        text: "Apakah Anda yakin ingin memverifikasi pembayaran ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Verifikasi!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Admin/verifikasiPembayaran') ?>',
                type: 'POST',
                data: {
                    id_pembayaran: id_pembayaran
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat memproses permintaan',
                        'error'
                    );
                }
            });
        }
    });
}

// Fungsi tolak pembayaran
function tolakPembayaran(id_pembayaran) {
    Swal.fire({
        title: 'Tolak Pembayaran',
        text: "Masukkan alasan penolakan:",
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Tolak',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: (alasan) => {
            if (!alasan) {
                Swal.showValidationMessage('Alasan penolakan harus diisi');
            }
            return alasan;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Admin/tolakPembayaran') ?>',
                type: 'POST',
                data: {
                    id_pembayaran: id_pembayaran,
                    alasan_tolak: result.value
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat memproses permintaan',
                        'error'
                    );
                }
            });
        }
    });
}
</script>
<?= $this->endSection() ?>