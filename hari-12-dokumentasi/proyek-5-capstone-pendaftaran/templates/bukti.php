<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; margin: 15px; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 0; font-size: 16px; text-transform: uppercase; color: #111; }
        .header p { margin: 4px 0 0 0; font-size: 10px; color: #555; }
        .box-nomor { background: #e9ecef; border: 1px dashed #6c757d; padding: 8px; text-align: center; font-size: 13px; font-weight: bold; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px 10px; text-align: left; vertical-align: top; border-bottom: 1px solid #dee2e6; }
        th { width: 30%; background: #f8f9fa; font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; font-size: 9px; color: #777; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Bukti Pendaftaran Pelatihan</h2>
        <p>Lembaga Pelatihan Kerja & Pengembangan SDM</p>
    </div>

    <div class="box-nomor">
        NOMOR BUKTI: <?= e($noBukti) ?>
    </div>

    <table>
        <tr>
            <th>Nama Lengkap</th>
            <td>: <?= e($data['nama']) ?></td>
        </tr>
        <tr>
            <th>Alamat Email</th>
            <td>: <?= e($data['email']) ?></td>
        </tr>
        <tr>
            <th>Nomor HP</th>
            <td>: <?= e($data['no_hp']) ?></td>
        </tr>
        <tr>
            <th>Kelas Pelatihan</th>
            <td>: <?= e($data['nama_kelas']) ?></td>
        </tr>
        <tr>
            <th>Alamat Lengkap</th>
            <td>: <?= e($data['alamat'] ?: '-') ?></td>
        </tr>
        <tr>
            <th>Tanggal Daftar</th>
            <td>: <?= date('d-m-Y H:i', strtotime($data['tgl_daftar'])) ?> WIB</td>
        </tr>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak otomatis oleh sistem pada <?= date('d/m/Y H:i') ?> WIB.</p>
    </div>

</body>
</html>