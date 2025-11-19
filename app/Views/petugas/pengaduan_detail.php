<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
     <link rel="stylesheet" href="/css/stylee3.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="detail-container">

    <div class="detail-card">
        <h1 class="detail-title">Detail Pengaduan</h1>

        <h2 class="detail-name"><?= esc($pengaduan['nama_pengaduan']); ?></h2>

        <p class="detail-text"><strong>Deskripsi:</strong> <?= esc($pengaduan['deskripsi']); ?></p>
        <p class="detail-text"><strong>Lokasi:</strong> <?= esc($pengaduan['lokasi']); ?></p>
        <p class="detail-text"><strong>Kategori:</strong> <?= esc($pengaduan['kategori']); ?></p>

        <?php if ($pengaduan['foto']): ?>
            <img class="detail-image" src="/uploads/<?= esc($pengaduan['foto']); ?>" width="200">
        <?php endif; ?>

        <hr class="detail-divider">

        <?php if ($pengaduan['status'] !== 'Selesai'): ?>
            <form class="detail-form" action="/pengaduan_petugas/update/<?= $pengaduan['id_pengaduan']; ?>" method="post">

                <label class="detail-label">Status:</label>
                <select name="status" class="detail-select" required>
                    <option value="Disetujui" <?= $pengaduan['status'] === 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                    <option value="Diproses" <?= $pengaduan['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                    <option value="Ditolak" <?= $pengaduan['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    <option value="Selesai" <?= $pengaduan['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>

                <label class="detail-label">Saran Petugas:</label>
                <textarea name="saran_petugas" class="detail-textarea" rows="4"><?= esc($pengaduan['saran_petugas']); ?></textarea>

                <button type="submit" class="detail-btn">Update Pengaduan</button>
            </form>

        <?php else: ?>
            <p class="detail-text"><strong>Status:</strong> <?= esc($pengaduan['status']); ?></p>
            <p class="detail-text"><strong>Tanggal Selesai:</strong> <?= esc($pengaduan['tgl_selesai']); ?></p>
            <p class="detail-text"><strong>Saran Petugas:</strong> <?= esc($pengaduan['saran_petugas']); ?></p>
            <p class="detail-finished"><em>Pengaduan ini sudah selesai dan tidak dapat diubah.</em></p>
        <?php endif; ?>

        <a href="/pengaduan_petugas" class="detail-back">← Kembali ke daftar</a>
    </div>

</div>

</body>
</html>