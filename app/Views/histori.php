<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Histori | InfrastrukturKu</title>

    <link rel="stylesheet" href="/css/coba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<div class="container">

    <?= $this->include('layout/sidebar') ?>

    <div class="content">
        <div class="topbar">
            <h1>Histori</h1>
        </div>

<div class="histori-list">

    <?php if (empty($pengaduan)): ?>
        <div class="empty">Belum ada pengaduan.</div>
    <?php else: ?>
        <?php foreach ($pengaduan as $p): ?>
            <div class="card">

                <div class="card-left">
                    <h3 class="card-title"><?= esc($p['nama_pengaduan']) ?></h3>
                    <p class="card-desc"><?= nl2br(esc($p['deskripsi'] ?? '-')) ?></p>

                    <div class="meta">
                        <span class="meta-item"><strong>Lokasi:</strong> <?= esc($p['nama_lokasi'] ?? '-') ?></span>
                        <span class="meta-item"><strong>Item:</strong> <?= esc($p['nama_item'] ?? '-') ?></span>
                        <span class="meta-item"><strong>Diajukan:</strong> <?= date('Y-m-d H:i', strtotime($p['tgl_pengajuan'])) ?></span>
                        <span class="meta-item"><strong>Selesai:</strong> 
                            <?= (!empty($p['tgl_selesai']) && $p['tgl_selesai'] !== '0000-00-00 00:00:00')
                                    ? date('Y-m-d H:i', strtotime($p['tgl_selesai']))
                                    : '-' ?>
                        </span>
                    </div>

                    <div class="saran">
                        <strong>Saran Petugas:</strong>
                        <div><?= $p['saran_petugas'] ? esc($p['saran_petugas']) : '-' ?></div>
                    </div>
                </div>

                <div class="card-right">
                    <?php if (!empty($p['foto'])): ?>
                        <div class="foto-wrap">
                            <img src="<?= base_url('uploads/' . $p['foto']); ?>" width="150" alt="Foto Pengaduan">
                        </div>
                    <?php else: ?>
                        <div class="foto-wrap placeholder">No Photo</div>
                    <?php endif; ?>

                    <?php
                        $status = strtolower($p['status']);
                        if ($status === 'diajukan' || $status === 'ditolak') $cls = 'status-red';
                        elseif ($status === 'disetujui' || $status === 'diproses') $cls = 'status-yellow';
                        elseif ($status === 'selesai') $cls = 'status-green';
                        else $cls = 'status-gray';
                    ?>
                    <span class="status-badge <?= $cls ?>"><?= esc($p['status']) ?></span>
                </div>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>


</div>

</body>
</html>