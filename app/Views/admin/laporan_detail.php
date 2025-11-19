<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="laporan-paper">
    <h2 class="laporan-paper-title">Laporan Pengaduan Sarana Prasarana</h2>

    <p class="laporan-paper-range">
        Periode: <?= esc($laporan['tanggal_awal']); ?> → <?= esc($laporan['tanggal_akhir']); ?>
    </p>

    <hr class="laporan-divider">

    <?php foreach ($pengaduan as $p): ?>
        <div class="laporan-entry">

            <p><strong>ID Pengaduan:</strong> <?= esc($p['id_pengaduan']); ?></p>
            <p><strong>Nama Pengaduan:</strong> <?= esc($p['nama_pengaduan']); ?></p>
            <p><strong>Deskripsi:</strong> <?= esc($p['deskripsi']); ?></p>
            <p><strong>Lokasi:</strong> <?= esc($p['lokasi']); ?></p>
            <p><strong>ID Item:</strong> <?= esc($p['id_item']); ?></p>
            <p><strong>Tanggal Pengajuan:</strong> <?= esc($p['tgl_pengajuan']); ?></p>
            <p><strong>Tanggal Selesai:</strong> <?= esc($p['tgl_selesai']); ?></p>
            <p><strong>Saran Petugas:</strong> <?= esc($p['saran_petugas']); ?></p>
            <p><strong>Status:</strong> <?= esc($p['status']); ?></p>
            <p><strong>ID User:</strong> <?= esc($p['id_user']); ?></p>
            <p><strong>ID Petugas:</strong> <?= esc($p['id_petugas']); ?></p>

            <p><strong>Foto:</strong></p>
            <?php if (!empty($p['foto'])): ?>
                <img src="<?= base_url('uploads/' . $p['foto']); ?>" class="laporan-foto">
            <?php else: ?>
                <p>Tidak ada foto</p>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
</div>

<a href="/admin/laporan" class="btn-kembali">Kembali</a>
</body>
</html>