<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="container">

        <?php include('layout/sidebar_petugas.php'); ?>

            <div class="content">

                <div class="topbar">
                    <h1>Profil Petugas</h1>
                    <div class="user-icon">
                        <a href="#" title="Lihat Profil"><i class="fa-solid fa-user"></i></a>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-pic"></div>
                        <div class="edit-icon" onclick="openPopup()">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>

                    <div class="profile-body">
                        <h2><?= esc($user['nama_pengguna']) ?></h2>
                        <div class="info">
                            <p><strong>Username</strong> : <?= esc($user['username']) ?></p>
                            <p><strong>Password</strong> : <?= esc($user['password']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- pop up edit -->
                <div class="popup" id="popup">
                    <div class="popup-content">
                        <h3>Edit Profil</h3>
                        <form action="/profil/update" method="post">
                            <label>Nama Pengguna</label>
                            <input type="text" name="nama_pengguna" value="<?= esc($user['nama_pengguna']) ?>" required>

                            <label>Username</label>
                            <input type="text" name="username" value="<?= esc($user['username']) ?>" required>

                            <label>Password</label>
                            <input type="text" name="password" value="<?= esc($user['password']) ?>" required>

                            <div class="popup-buttons">
                                <button type="submit" class="btn save">Simpan</button>
                                <button type="button" class="btn cancel" onclick="closePopup()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- pengaturan pop up nya -->
            <script>
                function openPopup() {
                    document.getElementById('popup').style.display = 'flex';
                }
                function closePopup() {
                    document.getElementById('popup').style.display = 'none';
                }
            </script>

    </div>  
</body>
</html>