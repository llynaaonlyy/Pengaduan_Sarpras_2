<div class="sidebar">
    <h2>InfrastrukturKu</h2>

    <ul class="menu">

        <li>
            <a href="/dashboard" class="<?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-home"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="/pengaduan" class="<?= (uri_string() == 'pengaduan') ? 'active' : '' ?>">
                <i class="fa-solid fa-comment-dots"></i>
                Pengaduan
            </a>
        </li>

        <li>
            <a href="/histori" class="<?= (uri_string() == 'histori') ? 'active' : '' ?>">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Histori
            </a>
        </li>

    </ul>

    <a href="/logout" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>
</div>
