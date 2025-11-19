<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="auth-body">

    <div class="register-container">

        <h3>REGISTRASI</h3>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php elseif (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="/register_action" method="post">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_pengguna" required>
                <label>Username</label>
                <input type="text" name="username" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <label>Role</label>
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Guru">Guru</option>
                    <option value="Siswa">Siswa</option>
                </select>
                <button type="submit" class="btn">REGISTRASI</button>
            </form>
            <p>Sudah punya akun? <a href="/login">Login</a></p>
    </div>
</body>
</html>