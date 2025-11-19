<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php include('layout/sidebar_petugas.php'); ?>

        <div class="content">

            <div class="topbar">
                <h1>Dashboard</h1>
                <div class="user-icon">
                    <a href="/profil_petugas" title="Lihat Profil"><i class="fa-solid fa-user"></i></a>
                </div>
            </div>

            <div class="welcome-card">
                <h2>Halo, <?= esc($user['username']); ?> 👋</h2>
                <p>Selamat datang di <strong>InfrastrukturKu</strong>.  
                Tetap Semangat Menjaga Sarpras!</p>
            </div>

            <div class="welcome-card">
                <p>Setiap fasilitas yang kembali berfungsi adalah bukti nyata dedikasi kita. 
                Terima kasih telah menjaga kenyamanan dan kelancaran bersama.</p>
            </div>

        </div>
    </div>
</body>
</html>