<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Histori | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container">
    <?= $this->include('layout/sidebar_admin') ?>

    <div class="content">

        <div class="topbar">
            <h1>Histori</h1>
        </div>

    <div class="histori-list">

       <!-- ngecek data pengaduan -->
      <?php if (!empty($pengaduan)): ?>

        <!-- looping untuk tiap pengaduan -->
        <?php foreach ($pengaduan as $p): ?>

           <!-- nampilin semua isi dari data pengaduann-->
          <div class="card">
            <div class="card-left">
              <h3 class="card-title"><?= esc($p['nama_pengaduan']); ?></h3>
              <p class="card-desc"><?= esc($p['deskripsi']); ?></p>

              <div class="meta">
                <div class="meta-item">Tanggal: <?= esc($p['tgl_pengajuan']); ?></div>
                <div class="meta-item">Lokasi: <?= esc($p['lokasi']); ?></div>
                <div class="meta-item">Status: 
                  <span class="status-badge 
                    <?= ($p['status'] == 'selesai') ? 'status-green' : 
                        (($p['status'] == 'proses') ? 'status-yellow' : 
                        (($p['status'] == 'ditolak') ? 'status-red' : 'status-gray')); ?>">
                    <?= esc($p['status']); ?>
                  </span>
                </div>
                <div class="meta-item">ID User: <?= esc($p['id_user']); ?></div>
                <div class="meta-item">ID Petugas: <?= esc($p['id_petugas']); ?></div>
              </div>

              <div class="saran">
                <strong>Saran Petugas:</strong> 
                <div><?= $p['saran_petugas'] ? esc($p['saran_petugas']) : '-'; ?></div>
              </div>
            </div>

            <div class="card-right">
              <?php if (!empty($p['foto'])): ?>
                <div class="foto-wrap">
                  <img src="<?= base_url('uploads/' . $p['foto']); ?>" alt="Foto Pengaduan" width="150">
                </div>
              <?php else: ?>
                <div class="foto-wrap placeholder">No Photo</div>
              <?php endif; ?>

              <?php if (!empty($p['tanggal_selesai'])): ?>
                <div class="meta-item">Selesai: <?= esc($p['tanggal_selesai']); ?></div>
              <?php endif; ?>

              <!-- hapus -->
            <a href="/histori_admin/delete/<?= $p['id_pengaduan']; ?>"
              class="btn-hapus"
              onclick="return confirm('Yakin ingin menghapus histori ini?')">Hapus</a>

            </div>
          </div>
        <?php endforeach; ?>

        <!--kalau belum ada histori-->
      <?php else: ?>
        <div class="empty">Belum ada histori pengaduan dari pengguna.</div>
      <?php endif; ?>
    </div>

    </div>
</div>
</body>
</html>