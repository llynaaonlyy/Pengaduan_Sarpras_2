<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="auth-body">

    <div class="login-container">

        <div class="login-left">
            <h2>Welcome to InfrastrukturKu!</h2>
            <p>Platform Pengaduan Sarana dan Prasarana untuk Mewujudkan Lingkungan yang Lebih Baik.</p>
        </div>

        <div class="login-right">

            <h3>LOGIN</h3>

            <!-- notif -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php elseif (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- input form -->
            <form action="/login_action" method="post">
                <label>Username</label>
                <input type="text" name="username" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <button type="submit" class="btn">LOGIN</button>
            </form>

            <!-- ke form regis -->
            <p>Belum punya akun? <a href="/register">Registrasi</a></p>

        </div>>
    </div>
</body>
</html>