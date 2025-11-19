<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php include('layout/sidebar_admin.php'); ?>

        <div class="content">
            <div class="topbar">
                <h1>Dashboard</h1>
                <div class="user-icon">
                    <a href="/profil" title="Lihat Profil"><i class="fa-solid fa-user"></i></a>
                </div>
            </div>

            <!--Jumlah tiap menu -->
            <div class="stats-grid">
                <div class="stat-card user">
                    <i class="fa-solid fa-users"></i>
                    <h3>Jumlah User</h3>
                    <p><?= $jumlah_user ?? 0; ?></p>
                </div>

                <div class="stat-card item">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <h3>Jumlah Item</h3>
                    <p><?= $jumlah_item ?? 0; ?></p>
                </div>

                <div class="stat-card lokasi">
                    <i class="fa-solid fa-location-dot"></i>
                    <h3>Jumlah Lokasi</h3>
                    <p><?= $jumlah_lokasi ?? 0; ?></p>
                </div>

                <div class="stat-card list">
                    <i class="fa-solid fa-map-location"></i>
                    <h3>Jumlah List Lokasi</h3>
                    <p><?= $jumlah_list_lokasi ?? 0; ?></p>
                </div>

                <div class="stat-card pengaduan">
                    <i class="fa-solid fa-comment-dots"></i>
                    <h3>Jumlah Pengaduan</h3>
                    <p><?= $jumlah_pengaduan ?? 0; ?></p>
                </div>

                <div class="stat-card laporan">
                    <i class="fa-solid fa-file-lines"></i>
                    <h3>Laporan</h3>
                    <p><?= $jumlah_laporan ?? 0; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>