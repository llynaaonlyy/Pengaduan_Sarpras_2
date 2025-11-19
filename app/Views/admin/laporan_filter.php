<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Laporan | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container">
    <?php include(APPPATH . 'Views/layout/sidebar_admin.php'); ?>

    <div class="content">
        <div class="topbar">
            <h1>Hasil Penyaringan</h1>
        </div>

        <div class="laporan-range-info">
            <p>Data dari tanggal <strong><?= esc($start); ?></strong> sampai <strong><?= esc($end); ?></strong></p>
        </div>

        <?php if (empty($dataPengaduan)): ?>
            <p class="laporan-empty">Belum ada data pengaduan pada rentang tanggal ini.</p>
        <?php else: ?>

            <div class="laporan-table-wrapper">
                <table class="laporan-table">
                    <thead>
                        <tr>
                            <th>Nama Pengaduan</th>
                            <th>ID Item</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPengaduan as $p): ?>
                            <tr>
                                <td><?= esc($p['nama_pengaduan']); ?></td>
                                <td><?= esc($p['id_item']); ?></td>
                                <td><?= esc($p['lokasi']); ?></td>
                                <td><?= esc($p['tgl_pengajuan']); ?></td>
                                <td><?= esc($p['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

           <form action="/admin/laporan/create" method="post">
                <input type="hidden" name="start" value="<?= $start; ?>">
                <input type="hidden" name="end" value="<?= $end; ?>">

                <button type="submit" class="laporan-btn-primary laporan-btn-full">
                    <i class="fa-solid fa-file-lines"></i> Buat Laporan
                </button>
            </form>

        <?php endif; ?>

        <br>
        <a href="/admin/laporan" class="laporan-btn-secondary">Kembali</a>
    </div>
</div>

</body>
</html>