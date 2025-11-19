<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/coba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="container">

        <?php include('layout/sidebar.php'); ?>

        <div class="content">

            <div class="topbar">
                <h1>Dashboard</h1>
                  <div class="user-icon">
                      <a href="/profil_pengguna" title="Lihat Profil"><i class="fa-solid fa-user"></i></a>
                  </div>
            </div>
                 
            <div class="welcome-card">
              <h2>Halo, <?= esc($user['username']); ?> 👋</h2>
              <p>Selamat datang di <strong>InfrastrukturKu</strong>.  
              Laporkan sarpras yang perlu perbaikan, dan pantau statusnya dengan mudah!</p>
            </div>

            <div class="stats-container">

              <div class="stat-card pengaduan">
                <i class="fa-solid fa-file-pen"></i>
                <h3><?= $jumlah_pengaduan; ?></h3>
                <p>Jumlah Pengaduan</p>
              </div>
              
            </div>

        </div>
    </div>
</body>
</html>