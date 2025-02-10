<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .photo-container {
            width: 3cm;
            height: 4cm;
            border: 1px solid #000;
            margin: 10px auto;
        }
        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table td {
            padding: 5px;
            vertical-align: top;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>FORMULIR PENDAFTARAN SANTRI BARU</h2>
        <h3><?= $santri['jenjang'] ?> TAHUN <?= date('Y') ?></h3>
    </div>

    <div class="row">
        <div style="float: right;">
            <div class="photo-container">
                <img src="<?= base_url('foto/santri/' . $santri['foto']) ?>" alt="Foto Santri" class="photo">
            </div>
        </div>

        <div class="section-title">DATA PENDAFTARAN</div>
        <table>
            <tr>
                <td width="200">No. Pendaftaran</td>
                <td>: <?= $santri['no_pendaftaran'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Daftar</td>
                <td>: <?= date('d-m-Y', strtotime($santri['created_at'])) ?></td>
            </tr>
        </table>

        <div class="section-title">DATA PRIBADI</div>
        <table>
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

        <div class="section-title">DATA ORANG TUA</div>
        <table>
            <!-- Data Ayah -->
            <tr>
                <td colspan="2"><strong>Data Ayah</strong></td>
            </tr>
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

            <!-- Data Ibu -->
            <tr>
                <td colspan="2"><strong>Data Ibu</strong></td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
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

            <!-- Data Wali (jika ada) -->
            <?php if (!empty($detail['nama_wali'])): ?>
            <tr>
                <td colspan="2"><strong>Data Wali</strong></td>
            </tr>
            <tr>
                <td>Nama Wali</td>
                <td>: <?= $detail['nama_wali'] ?></td>
            </tr>
            <tr>
                <td>NIK Wali</td>
                <td>: <?= $detail['nik_wali'] ?></td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>: <?= $detail['pendidikan_wali'] ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: <?= $detail['pekerjaan_wali'] ?></td>
            </tr>
            <tr>
                <td>Penghasilan</td>
                <td>: <?= $detail['penghasilan_wali'] ?></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>: <?= $detail['no_hp_wali'] ?></td>
            </tr>
            <?php endif; ?>
        </table>

        <!-- Tanda Tangan -->
        <div style="margin-top: 50px; float: right; text-align: center;">
            <p>........................., <?= date('d-m-Y') ?></p>
            <p>Pendaftar</p>
            <br><br><br>
            <p><u><?= $santri['nama_lengkap'] ?></u></p>
        </div>
    </div>
</body>
</html> 