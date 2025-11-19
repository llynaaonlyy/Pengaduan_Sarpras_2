<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Item | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">

        <?php include('layout/sidebar_admin.php'); ?>

            <div class="content">

                <div class="topbar">
                    <h1>Temporary Item</h1>
                </div>

                <!-- header tabel -->
                <table>
                    <tr>
                        <th>No</th>
                        <th>ID Temporary</th>
                        <th>ID Item</th>
                        <th>Nama Barang Baru</th>
                        <th>Lokasi Barang Baru</th>
                        <th>Aksi</th>
                    </tr>

                    <?php if (!empty($row)): ?>

                    <!--looping data temporary item-->
                    <?php $no = 1; foreach ($row as $tempoary_item): ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($tempoary_item['id_temporary']); ?></td>
                        <td><?= esc($tempoary_item['id_item']); ?></td>
                        <td><?= esc($tempoary_item['nama_barang_baru']); ?></td>
                        <td><?= esc($tempoary_item['lokasi_barang_baru']); ?></td>
                        <td class="aksi">
                            <a href="/temporary_item/delete/<?= $tempoary_item['id_temporary']; ?>" 
                            class="btn-hapus" 
                            onclick="return confirm('Yakin ingin menghapus item ini?')">
                            <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">Belum ada data Temporary Item.</td>
                        </tr>
                    <?php endif; ?>

                </table>
            </div>
</body>
</html>