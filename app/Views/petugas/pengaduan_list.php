<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengaduan | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
      <div class="container">
    <?php include(APPPATH . 'Views/layout/sidebar_petugas.php'); ?>
    <div class="content">

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>


      <div class="topbar">
        <h1>Manajemen Pengaduan</h1>
      </div>

         <?php if (!empty($pengaduan)): ?>
        <?php foreach ($pengaduan as $p): ?>
            <div class="card">
                <div class="card-left">
                    <h2><?= esc($p['nama_pengaduan']); ?></h2>
                    <p><?= esc($p['deskripsi']); ?></p>
                    <small><?= esc($p['lokasi']); ?></small><br>
                    <small>Status: <?= esc($p['status']); ?></small><br>
                    <a href="/pengaduan_petugas/detail/<?= $p['id_pengaduan']; ?>">Lihat Selengkapnya</a>
                </div>
                <div class="card-right">
                    <?php if ($p['foto']): ?>
                        <img src="/uploads/<?= esc($p['foto']); ?>" width="120">
                    <?php else: ?>
                        <span>Tidak ada foto</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada pengaduan masuk.</p>
    <?php endif; ?>

      </div>
      </div>
</body>
</html>