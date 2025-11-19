<div class="sidebar">
    <h2>InfrastrukturKu</h2>
    <ul class="menu">

        <li>
            <a href="/dashboard_petugas" class="<?= (uri_string() == 'dashboard_petugas') ? 'active' : '' ?>">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="/manajemen_pengaduan" class="<?= (uri_string() == 'manajemen_pengaduan') ? 'active' : '' ?>">
                <i class="fas fa-tasks"></i>
                Manajemen Pengaduan
            </a>
        </li>

    </ul>

    <a href="/logout" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i>
        Logout
    </a>
</div>