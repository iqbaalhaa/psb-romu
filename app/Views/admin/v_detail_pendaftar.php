<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Pendaftar <?= $santri['jenjang'] ?></h4>
            <a href="<?= base_url('Admin/CetakDetail/' . $santri['id_santri']) ?>" class="btn btn-dark" target="_blank">
                <i class="fas fa-print"></i> Cetak
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Kolom Data -->
                <div class="col-md-10">
                    <!-- Data Pendaftaran -->
                    <h5 class="border-bottom pb-2">Data Pendaftaran</h5>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td width="200">No. Pendaftaran</td>
                                    <td>: <?= $santri['no_pendaftaran'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Daftar</td>
                                    <td>: <?= date('d-m-Y', strtotime($santri['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>: 
                                        <?php if ($pembayaran['status_pembayaran'] == 2): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php elseif ($pembayaran['status_pembayaran'] == 1): ?>
                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum Bayar</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Berkas</td>
                                    <td>: 
                                        <?php if ($santri['status_berkas'] == 1): ?>
                                            <span class="badge bg-success">Lengkap</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum Lengkap</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Pribadi -->
                    <h5 class="border-bottom pb-2">Data Pribadi</h5>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td width="200">NISN</td>
                                    <td>: <?= $santri['nisn'] ?></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: <?= $santri['nik'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>: <?= $santri['nama_lengkap'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td>: <?= $santri['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($santri['tgl_lahir'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>: <?= $santri['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>: <?= $santri['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td>: <?= $santri['asal_sekolah'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat Lengkap</td>
                                    <td>: <?= $detail['alamat'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Desa/Kelurahan</td>
                                    <td>: <?= $detail['desa'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>: <?= $detail['kecamatan'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kabupaten/Kota</td>
                                    <td>: <?= $detail['kabupaten'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>: <?= $detail['provinsi'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>: <?= $detail['kode_pos'] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Orang Tua -->
                    <h5 class="border-bottom pb-2">Data Orang Tua</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Ayah</h6>
                            <table class="table">
                                <tr>
                                    <td width="200">Nama Ayah</td>
                                    <td>: <?= $detail['nama_ayah'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>NIK Ayah</td>
                                    <td>: <?= $detail['nik_ayah'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: <?= $detail['pendidikan_ayah'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: <?= $detail['pekerjaan_ayah'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Penghasilan</td>
                                    <td>: <?= $detail['penghasilan_ayah'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>: <?= $detail['no_hp_ayah'] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Data Ibu</h6>
                            <table class="table">
                                <tr>
                                    <td width="200">Nama Ibu</td>
                                    <td>: <?= $detail['nama_ibu'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>NIK Ibu</td>
                                    <td>: <?= $detail['nik_ibu'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: <?= $detail['pendidikan_ibu'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: <?= $detail['pekerjaan_ibu'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Penghasilan</td>
                                    <td>: <?= $detail['penghasilan_ibu'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>: <?= $detail['no_hp_ibu'] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Wali (jika ada) -->
                    <?php if (!empty($detail['nama_wali'])): ?>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6>Data Wali</h6>
                            <table class="table">
                                <tr>
                                    <td width="200">Nama Wali</td>
                                    <td>: <?= $detail['nama_wali'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>NIK Wali</td>
                                    <td>: <?= $detail['nik_wali'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: <?= $detail['pendidikan_wali'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: <?= $detail['pekerjaan_wali'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Penghasilan</td>
                                    <td>: <?= $detail['penghasilan_wali'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>: <?= $detail['no_hp_wali'] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mt-4">
                        <a href="<?= base_url('Admin/Pendaftar' . $santri['jenjang']) ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <!-- Kolom Foto -->
                <div class="col-md-2 text-center">
                    <div class="border p-2" style="width: 3cm; height: 4cm; margin: 0 auto;">
                        <img src="<?= base_url('foto/santri/' . $santri['foto']) ?>" 
                             alt="Foto Santri"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 