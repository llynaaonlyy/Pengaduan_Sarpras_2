<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container">
    <?php include(APPPATH . 'Views/layout/sidebar_admin.php'); ?>

    <div class="content">
        <div class="topbar">
            <h1>Laporan</h1>
        </div>

        <!-- === FORM FILTER TANGGAL === -->
        <div class="laporan-filter-box">
           <form action="/admin/laporan/filter" method="get" class="laporan-filter-form">
                <div>
                    <label>Dari Tanggal</label>
                    <input type="date" name="start" required>
                </div>

                <div>
                    <label>Sampai Tanggal</label>
                    <input type="date" name="end" required>
                </div>

                <button type="submit" class="laporan-btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
            </form>
        </div>

        <!-- === DAFTAR LAPORAN YANG SUDAH DIBUAT === -->
        <h2 class="laporan-subtitle">Laporan Terbaru</h2>

        <?php if (empty($laporan)): ?>
            <p class="laporan-empty">Belum ada laporan yang dibuat.</p>
        <?php else: ?>
            <div class="laporan-list">
                <?php foreach ($laporan as $l): ?>
                    <div class="laporan-card">
                        <h3>Rentan Tanggal</h3>
                        <p><?= esc($l['tanggal_awal']); ?> → <?= esc($l['tanggal_akhir']); ?></p>

                        <a href="/admin/laporan/detail/<?= $l['id_laporan']; ?>"
                           class="laporan-btn-secondary">Lihat Detail</a>
                        <a href="/admin/laporan/delete/<?= $l['id_laporan']; ?>"
                            class="laporan-btn-danger"
                            onclick="return confirm('Yakin ingin menghapus laporan ini?');">Hapus </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>