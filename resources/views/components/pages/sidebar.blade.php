<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header"><a href="/"
                class="b-brand text-primary"><!-- ========   Change your logo from here   ============ --> <img
                    src="https://html.phoenixcoded.net/light-able/bootstrap/default/assets/images/logo-dark.svg"
                    alt="logo image" class="logo-lg"> <span
                    class="badge bg-brand-color-2 rounded-pill ms-1 theme-version">v1.3.0</span></a></div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label data-i18n="Navigation">Menu</label> <i
                        class="ph-duotone ph-gauge"></i></li>
                <li class="pc-item"><a href="/" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-gauge"></i>
                        </span><span class="pc-mtext" data-i18n="Statistics">Dashboard</span></a></li>
                <li class="pc-item pc-caption"><label data-i18n="Widget">Manajemen</label> <i
                        class="ph-duotone ph-chart-pie"></i></li>
                <li class="pc-item"><a href="/kategori" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-archive"></i>
                        </span><span class="pc-mtext" data-i18n="Statistics">Kategori</span></a></li>
                <li class="pc-item"><a href="/menu" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-article-medium"></i>
                        </span><span class="pc-mtext" data-i18n="Statistics">Menu</span></a></li>
                <li class="pc-item"><a href="/kriteria" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-align-center-vertical"></i>
                        </span><span class="pc-mtext" data-i18n="Statistics">Kriteria</span></a></li>
                <li class="pc-item"><a href="/metode" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-money"></i>
                        </span><span class="pc-mtext" data-i18n="Statistics">Pembayaran</span></a></li>
                <li class="pc-item"><a href="/karyawan" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-identification-card"></i>
                        </span><span class="pc-mtext" data-i18n="User">Karyawan</span></a></li>
                <li class="pc-item pc-caption"><label data-i18n="Navigation">Kasir</label> <i
                        class="ph-duotone ph-gauge"></i></li>
                <li class="pc-item"><a href="/pos" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-shopping-cart-simple"></i>
                        </span><span class="pc-mtext" data-i18n="User">POS</span></a></li>
                <li class="pc-item"><a href="#" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-notebook"></i>
                        </span><span class="pc-mtext" data-i18n="User">Pesanan Hari Ini</span></a></li>
        </div>
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0"><img src="{{ asset('able') }}/assets/images/user/avatar-1.jpg"
                            alt="user-image" class="user-avtar wid-45 rounded-circle"></div>
                    <div class="flex-grow-1 ms-3">
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex align-items-center">
                                <!-- Bagian Nama User -->
                                <div class="flex-grow-1 me-2">
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                </div>

                                <!-- Bagian Tombol Logout -->
                                <div class="flex-shrink-0">
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-link-secondary avtar"
                                            style="border: none; outline: none; background: transparent;">
                                            <i class="ph-duotone ph-power"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav><!-- [ Sidebar Menu ] end --><!-- [ Header Topbar ] start -->
