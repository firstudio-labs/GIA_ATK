@extends('template_web.layout')
@section('content')

    <!-- breadcrumb start -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="radios-breadcrumb breadcrumbs">
                <ul class="list-unstyled d-flex align-items-center">
                    <li class="radiosbcrumb-item radiosbcrumb-begin">
                        <a href="{{ route('landing') }}"><span>Beranda</span></a>
                    </li>
                    <li class="radiosbcrumb-item radiosbcrumb-end">
                        <span>Belanja</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- start shop-section -->
    <section class="shop-section pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="shop-area shop-left-sidebar clearfix">
                        <div class="woocommerce-content-wrap">
                            <div class="woocommerce-toolbar-top">
                                <p class="woocommerce-result-count">
                                    Menampilkan {{ $produks->firstItem() ?? 0 }}–{{ $produks->lastItem() ?? 0 }} dari {{ $produks->total() }} hasil
                                </p>
                                <div class="products-sizes">
                                    <a href="#!" class="grid-3 active">
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                </div>
                                <form class="woocommerce-ordering" method="get" action="{{ route('shop') }}" id="sortForm">
                                    @if(request('kategori'))
                                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                    @endif
                                    @if(request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @if(request('ukuran'))
                                        <input type="hidden" name="ukuran" value="{{ request('ukuran') }}">
                                    @endif
                                    @if(request('warna'))
                                        <input type="hidden" name="warna" value="{{ request('warna') }}">
                                    @endif
                                    @if(request('min_price'))
                                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                    @endif
                                    @if(request('max_price'))
                                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                    @endif
                                    <select name="sort" class="orderby" onchange="this.form.submit()">
                                        <option value="latest" {{ !request('sort') || request('sort') == 'latest' ? 'selected' : '' }}>Urutkan Terbaru</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                                    </select>
                                </form>
                            </div>
                            <div class="woocommerce-content-inner">
                                <ul class="products three-column clearfix">
                                    @forelse($produks as $produk)
                                        <li class="product">
                                            <div class="product-holder" style="position: relative;">
                                                @php
                                                    $gambar = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0 
                                                        ? asset('produk/gambar/' . $produk->gambar_produk[0])
                                                        : asset('web/assets/img/product/p-1.jpg');
                                                @endphp
                                                <a href="{{ route('shop.detail', $produk->slug) }}">
                                                    <img src="{{ $gambar }}" alt="{{ $produk->judul }}" style="width: 100%; height: auto; display: block; object-fit: cover; max-height: 230px;">
                                                </a>
                                                <ul class="product__action">
                                                    <li>
                                                        <a href="{{ route('shop.detail', $produk->slug) }}">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                                        @php
                                                            $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                                            $pesan = "Halo, saya tertarik dengan produk: " . $produk->judul;
                                                            $waLink = "https://wa.me/" . $no_wa_clean . "?text=" . urlencode($pesan);
                                                        @endphp
                                                        <li>
                                                            <a href="{{ $waLink }}" target="_blank">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="product-info" style="padding-top:15px;">
                                                {{-- Hapus rating --}}

                                                <h2 class="product__title" style="min-height: 44px;">
                                                    <a href="{{ route('shop.detail', $produk->slug) }}">{{ $produk->judul }}</a>
                                                </h2>
                                                @if($produk->kategori)
                                                    <span class="product__available">Kategori: <span>{{ $produk->kategori->nama_kategori }}</span></span>
                                                @endif
                                                <h4 class="product__price">
                                                    @if($produk->diskon > 0)
                                                        @php
                                                            $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon / 100);
                                                        @endphp
                                                        <span class="new">Rp {{ number_format($hargaDiskon, 0, ',', '.') }}</span>
                                                        <span class="old">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="new">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                    @endif
                                                </h4>
                                                @if($produk->deskripsi)
                                                    <p class="product-description">{{ \Illuminate\Support\Str::limit($produk->deskripsi, 150) }}</p>
                                                @endif
                                            </div>
                                        </li>
                                    @empty
                                        <li class="product" style="width: 100%;">
                                            <div class="alert alert-info text-center" style="padding: 40px; margin: 20px;">
                                                <p>Tidak ada produk yang tersedia saat ini.</p>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                            @if($produks->hasPages())
                                <div class="pagination_wrap pt-20">
                                    <ul>
                                        @if($produks->onFirstPage())
                                            <li><span style="opacity: 0.5; cursor: not-allowed;"><i class="far fa-angle-double-left"></i></span></li>
                                        @else
                                            <li><a href="{{ $produks->appends(request()->query())->previousPageUrl() }}"><i class="far fa-angle-double-left"></i></a></li>
                                        @endif
                                        
                                        @php
                                            $currentPage = $produks->currentPage();
                                            $lastPage = $produks->lastPage();
                                            $startPage = max(1, $currentPage - 2);
                                            $endPage = min($lastPage, $currentPage + 2);
                                        @endphp
                                        
                                        @if($startPage > 1)
                                            <li><a href="{{ $produks->appends(request()->query())->url(1) }}">1</a></li>
                                            @if($startPage > 2)
                                                <li><span>...</span></li>
                                            @endif
                                        @endif
                                        
                                        @for($page = $startPage; $page <= $endPage; $page++)
                                            @if($page == $currentPage)
                                                <li><a class="current_page" href="#!">{{ $page }}</a></li>
                                            @else
                                                <li><a href="{{ $produks->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                            @endif
                                        @endfor
                                        
                                        @if($endPage < $lastPage)
                                            @if($endPage < $lastPage - 1)
                                                <li><span>...</span></li>
                                            @endif
                                            <li><a href="{{ $produks->appends(request()->query())->url($lastPage) }}">{{ $lastPage }}</a></li>
                                        @endif
                                        
                                        @if($produks->hasMorePages())
                                            <li><a href="{{ $produks->appends(request()->query())->nextPageUrl() }}"><i class="far fa-angle-double-right"></i></a></li>
                                        @else
                                            <li><span style="opacity: 0.5; cursor: not-allowed;"><i class="far fa-angle-double-right"></i></span></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="shop-sidebar">
                            <!-- Search Widget -->
                            <div class="widget">
                                <h2 class="widget__title">
                                    <span>Cari Produk</span>
                                </h2>
                                <form class="widget__search" action="{{ route('shop') }}" method="GET">
                                    @if(request('kategori'))
                                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                    @endif
                                    @if(request('ukuran'))
                                        <input type="hidden" name="ukuran" value="{{ request('ukuran') }}">
                                    @endif
                                    @if(request('warna'))
                                        <input type="hidden" name="warna" value="{{ request('warna') }}">
                                    @endif
                                    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                                    <button type="submit"><i class="far fa-search"></i></button>
                                </form>
                            </div>

                            <!-- Category Widget -->
                            <div class="widget">
                                <h2 class="widget__title">
                                    <span>Kategori</span>
                                </h2>
                                <ul class="widget__category">
                                    <li>
                                        <a href="{{ route('shop') }}">
                                            Semua Kategori
                                            <i class="far fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    @foreach($kategoris as $kategori)
                                        <li>
                                            <a href="{{ route('shop', ['kategori' => $kategori->id]) }}" class="{{ request('kategori') == $kategori->id ? 'active' : '' }}">
                                                {{ $kategori->nama_kategori }}
                                                <i class="far fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Filter By Size -->
                            @if($ukuranList->count() > 0)
                            <div class="widget">
                                <h2 class="widget__title">
                                    <span>Filter Berdasarkan Ukuran</span>
                                </h2>
                                <div class="checkbox">
                                    <form action="{{ route('shop') }}" method="GET" id="sizeFilterForm">
                                        @if(request('kategori'))
                                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                        @endif
                                        @if(request('search'))
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                        @endif
                                        @if(request('warna'))
                                            <input type="hidden" name="warna" value="{{ request('warna') }}">
                                        @endif
                                        @foreach($ukuranList as $ukuran)
                                            <div class="checkbox__item ul_li">
                                                <input class="form-check-input" type="radio" name="ukuran" id="ukuran_{{ $loop->index }}" value="{{ $ukuran }}" {{ request('ukuran') == $ukuran ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label for="ukuran_{{ $loop->index }}">{{ $ukuran }}</label>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                            @endif

                            <!-- Filter By Color -->
                            @if($warnaList->count() > 0)
                            <div class="widget">
                                <h2 class="widget__title">
                                    <span>Filter Berdasarkan Warna</span>
                                </h2>
                                <div class="checkbox">
                                    <form action="{{ route('shop') }}" method="GET" id="colorFilterForm">
                                        @if(request('kategori'))
                                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                        @endif
                                        @if(request('search'))
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                        @endif
                                        @if(request('ukuran'))
                                            <input type="hidden" name="ukuran" value="{{ request('ukuran') }}">
                                        @endif
                                        @foreach($warnaList as $warna)
                                            <div class="checkbox__item ul_li">
                                                <input class="form-check-input" type="radio" name="warna" id="warna_{{ $loop->index }}" value="{{ $warna }}" {{ request('warna') == $warna ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label for="warna_{{ $loop->index }}">{{ $warna }}</label>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end shop-section -->

@endsection