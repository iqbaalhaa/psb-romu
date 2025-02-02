<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kartu Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kartu {
            width: 480px;
            margin: 0 auto;
            padding: 20px;
            border: 30px solid transparent;
            border-image: url('<?= base_url('assets/frame.png') ?>') 30 stretch;
            border-image-slice: 50 fill;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-top: 25px;
        }

        .foto {
            width: 3cm;
            height: 4cm;
            border: 1px solid #000;
            float: right;
            margin-left: 20px;
        }

        .info {
            margin-bottom: 100px;
        }

        /* .info table {
            width: 90%;
        } */

        .info td {
            padding: 5px;
        }

        .footer {
            margin: 30px 40px;
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="no-print" style="text-align: center; margin: 20px;">
        <button onclick="window.print()">Cetak Kartu</button>
        <a href="<?= base_url('Santri') ?>">
            <button>Kembali ke Dashboard</button>
        </a>
    </div>

    <div class="kartu">
        <div class="header">
            <img src="<?= base_url('assets/romu.png') ?>" class="logo">
            <h2>KARTU PENDAFTARAN SANTRI</h2>
            <h3>PONDOK PESANTREN</h3>
            <p>Tahun Ajaran <?= date('Y') ?>/<?= date('Y') + 1 ?></p>
        </div>

        <?php if (!empty($berkas['foto'])): ?>
            <img src="<?= base_url('berkas/' . $berkas['foto']) ?>" class="foto">
        <?php else: ?>
            <div class="foto">
                <p style="text-align: center;">Foto 3x4</p>
            </div>
        <?php endif; ?>

        <div class="info">
            <table>
                <tr>
                    <td width="200">No. Pendaftaran</td>
                    <td>: <?= $santri['no_pendaftaran'] ?></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>: <?= $santri['nama_lengkap'] ?></td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>: <?= $santri['nisn'] ?></td>
                </tr>
                <tr>
                    <td>Jenjang</td>
                    <td>: <?= $santri['jenjang'] ?></td>
                </tr>
                <tr>
                    <td>Gelombang</td>
                    <td>: <?= $santri['gelombang'] ?></td>
                </tr>
            </table>
        </div>
</body>

</html>