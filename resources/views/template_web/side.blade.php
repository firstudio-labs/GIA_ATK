 <!-- slide-bar start -->
 <aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fal fa-times"></i></a>
    </div>

    <!-- sidebar-info start -->
    @include('page_web.keranjang.keranjang')
    <!-- sidebar-info end -->

    <!-- side-mobile-menu start -->
    <nav class="side-mobile-menu">
        <div class="header-mobile-search">
            <form role="search" method="get" action="{{ route('shop') }}">
                <input type="text" name="search" placeholder="Cari Produk..." value="{{ request('search') }}">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
        <ul id="mobile-menu-active">
            <li><a href="{{ route('landing') }}">Beranda</a></li>
            <li><a href="{{ route('shop') }}">Toko</a></li>
            <!-- <li><a href="{{ route('about') }}">Tentang Kami</a></li> -->
            <li><a href="{{ route('kontak.index') }}">Kontak</a></li>
            <li><a href="/riwayat-pesanan">Riwayat Pesanan</a></li>
        </ul>
    </nav>
    

    <!-- side-mobile-menu end -->
</aside>