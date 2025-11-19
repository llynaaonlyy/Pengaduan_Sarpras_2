<div class="sidebar">
    <h2>InfrastrukturKu</h2>

    <ul class="menu">
        <li>
            <a href="/dashboard_admin" class="<?= (uri_string() == 'dashboard_admin') ? 'active' : '' ?>">
                <i class="fa-solid fa-home"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="/manajemen_user" class="<?= (uri_string() == 'manajemen_user') ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                Manajemen User
            </a>
        </li>

        <li>
            <a href="/item" class="<?= (uri_string() == 'item') ? 'active' : '' ?>">
                <i class="fa-solid fa-boxes-stacked"></i>
                Item
            </a>
        </li>

        <li>
            <a href="/lokasi" class="<?= (uri_string() == 'lokasi') ? 'active' : '' ?>">
                <i class="fa-solid fa-location-dot"></i>
                Lokasi
            </a>
        </li>

        <li>
            <a href="/list_lokasi" class="<?= (uri_string() == 'list_lokasi') ? 'active' : '' ?>">
                <i class="fa-solid fa-map-location-dot"></i>
                List Lokasi
            </a>
        </li>

        <li>
            <a href="/temporary_item" class="<?= (uri_string() == 'temporary_item') ? 'active' : '' ?>">
                <i class="fa-solid fa-clock"></i>
                Temporary Item
            </a>
        </li>

        <li>
            <a href="/histori_admin" class="<?= (uri_string() == 'histori_admin') ? 'active' : '' ?>">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Histori
            </a>
        </li>

        <li>
            <a href="/admin/laporan" class="<?= (uri_string() == 'admin/laporan') ? 'active' : '' ?>">
                <i class="fa-solid fa-file-lines"></i>
                Laporan
            </a>
        </li>

    </ul>

    <a href="/logout" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>
</div>