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
            <li class="dropdown">
                <a href="{{ route('shop') }}">Toko</a>
                @php
                    $kategoris = \App\Models\ManageKategori::with('produks')->whereHas('produks', function($query) {
                        $query->where('status', 'aktif');
                    })->get();
                @endphp
                @if($kategoris->isNotEmpty())
                <ul class="sub-menu">
                    @foreach($kategoris as $kategori)
                        <li><a href="{{ route('shop', ['kategori' => $kategori->id]) }}">{{ $kategori->nama_kategori }}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            <!-- <li><a href="{{ route('about') }}">Tentang Kami</a></li> -->
            <li><a href="{{ route('kontak.index') }}">Kontak</a></li>
        </ul>
    </nav>
    

    <!-- side-mobile-menu end -->
</aside>