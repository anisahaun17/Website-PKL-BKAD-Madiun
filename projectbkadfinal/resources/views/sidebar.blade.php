<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item {{ Route::is('pj.*') ? 'active' : '' }}">
        <a href="{{ route('pj.index') }}" class="nav-link {{ Route::is('pj.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
                Penanggung Jawab
            </p>
        </a>
    </li>
    <li class="nav-item {{ Route::is('asset.*') ? 'active' : '' }}">
        <a href="{{ route('asset.index') }}" class="nav-link {{ Route::is('asset.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-building"></i>
            <p>
                Aset
            </p>
        </a>
    </li>
    <li class="nav-item {{ Route::is('sewa.*') ? 'active' : '' }}">
        <a href="{{ route('sewa.index') }}" class="nav-link {{ Route::is('sewa.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-handshake"></i>
            <p>
                Sewa
            </p>
        </a>
    </li>
    <li class="nav-item {{ preg_match('/(skrd)/i',request()->route()->getName())? 'menu-open': '' }}">
        <a href="#" class="nav-link {{ preg_match('/(skrd)/i',request()->route()->getName())? 'active': '' }}">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>
                SKRD
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('skrd.index', 'belum-terbit') }}"
                    class="nav-link {{ Route::is('skrd.index') && request('status') === 'belum-terbit' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Belum Terbit</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('skrd.index', 'terbit') }}"
                    class="nav-link {{ Route::is('skrd.index') && request('status') === 'terbit' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Terbit</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('skrd.index', 'selesai') }}"
                    class="nav-link {{ Route::is('skrd.index') && request('status') === 'selesai' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Selesai</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item {{ Route::is('pembayaran.*') ? 'active' : '' }}">
        <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Route::is('pembayaran.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
                Pembayaran
            </p>
        </a>
    </li>
    <li
        class="nav-item {{ preg_match('/(jabatan|kategori|jenis)/i',request()->route()->getName())? 'menu-open': '' }}">
        <a href="#"
            class="nav-link {{ preg_match('/(jabatan|kategori|jenis)/i',request()->route()->getName())? 'active': '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('jabatan.index') }}" class="nav-link {{ Route::is('jabatan.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jabatan</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('kategori.index') }}"
                    class="nav-link {{ Route::is('kategori.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Aset</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('jenis.index') }}" class="nav-link {{ Route::is('jenis.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jenis Pelayanan</p>
                </a>
            </li>
        </ul>
    </li>
</ul>
