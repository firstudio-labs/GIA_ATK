@extends('template_web.layout')
@section('content')
@include('template_web.popup')

    <main>

        <!-- hero start -->
        <div class="hero hero__height ul_li" data-background="{{ asset('web') }}/assets/img/bg/hero_bg.jpg">
            <div class="container">
                <div class="row align-items-center mt-none-30">
                    <div class="col-lg-9 mt-30">
                        <div class="row align-items-center flex-row-reverse mt-none-30">
                            <div class="col-lg-7 mt-30">
                                @if($bestProduct->isNotEmpty())
                                <div class="hero__product">
                                    <div class="hero__product-wrap">
                                        <div class="hero__product-carousel">
                                            @foreach($bestProduct->take(5) as $produk)
                                                @php
                                                    $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                                        ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                                        : asset('web/assets/img/product/img_52.png');
                                                @endphp
                                                <div class="hero__product-item">
                                                    <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="hero__product-carousel-nav">
                                            @foreach($bestProduct->take(5) as $produk)
                                                @php
                                                    $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                                        ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                                        : asset('web/assets/img/product/img_52.png');
                                                @endphp
                                                <div class="hero__product-item-nav">
                                                    <div class="image">
                                                        <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @php
                                            $bestProductSection = $sections->get('Best Product');
                                        @endphp
                                        @if($bestProductSection && $bestProductSection->discount_percentage > 0)
                                        <span class="hero__product-offer">
                                            <span class="discount">{{ $bestProductSection->discount_percentage }}<span>%</span></span>
                                            <span>off</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-5 mt-30">
                                <div class="hero__content">
                                    @if($bestProduct->isNotEmpty())
                                        @php
                                            $heroProduk = $bestProduct->first();
                                            $bestProductSection = $sections->get('Best Product');
                                            // Gunakan discount_percentage dari section jika ada, jika tidak gunakan diskon produk
                                            $diskonValue = 0;
                                            if ($bestProductSection && $bestProductSection->discount_percentage > 0) {
                                                $diskonValue = $bestProductSection->discount_percentage;
                                            } elseif ($heroProduk->diskon > 0) {
                                                $diskonValue = $heroProduk->diskon;
                                            }
                                            $hargaDiskon = $diskonValue > 0 ? $heroProduk->harga - ($heroProduk->harga * $diskonValue / 100) : $heroProduk->harga;
                                        @endphp
                                        <span class="subtitle">100% Produk Terbaik</span>
                                        <h2 class="title">{{ Str::limit($heroProduk->judul, 50) }}</h2>
                                        @if($heroProduk->deskripsi)
                                            <p>{{ Str::limit($heroProduk->deskripsi, 100) }}</p>
                                        @endif
                                        <h3 class="price">Rp {{ number_format($hargaDiskon, 0, ',', '.') }} / <span>Rp {{ number_format($heroProduk->harga, 0, ',', '.') }}</span></h3>
                                    @else
                                        <span class="subtitle">100% Best Product</span>
                                        <h2 class="title">Waterma Watch <br> Beats Studio</h2>
                                        <p>Widescreen 4k ultra Laptop</p>
                                        <h3 class="price">Rp 0 / <span>Rp 0</span></h3>
                                    @endif
                                    <div class="mxw_343 mb-20">
                                        <div class="product__progress progress h-16 color-primary">
                                            <div class="progress-bar" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                       
                                    </div>
                                    <a class="hero__btn" href="{{ $bestProduct->isNotEmpty() ? route('shop.detail', $bestProduct->first()->slug) : route('shop') }}">Beli Sekarang <i class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-30">
                        <div class="hot-deal__slide-wrap style-2 bg-white ">
                            <h2 class="section-heading mb-25"><span>Produk Terpopuler</span></h2>
                            <div class="hot-deal__slide tx-arrow">
                                @php
                                    $topProdukSection = $sections->get('Top Produk');
                                @endphp
                                @forelse($topProduk->take(3) as $produk)
                                    @php
                                        $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                            ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                            : asset('web/assets/img/product/img_55.png');
                                        // Gunakan discount_percentage dari section jika ada, jika tidak gunakan diskon produk
                                        $diskonValue = 0;
                                        if ($topProdukSection && $topProdukSection->discount_percentage > 0) {
                                            $diskonValue = $topProdukSection->discount_percentage;
                                        } elseif ($produk->diskon > 0) {
                                            $diskonValue = $produk->diskon;
                                        }
                                        $hargaDiskon = $diskonValue > 0 ? $produk->harga - ($produk->harga * $diskonValue / 100) : $produk->harga;
                                    @endphp
                                    <div class="hot-deal__item text-center">
                                        <div class="thumb">
                                            <a href="{{ route('shop.detail', $produk->slug) }}">
                                                <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h2 class="title mb-15"><a href="{{ route('shop.detail', $produk->slug) }}">{{ Str::limit($produk->judul, 30) }}</a></h2>
                                            <h4 class="product__price mb-20">
                                                <span class="new">Rp {{ number_format($hargaDiskon, 0, ',', '.') }}</span>
                                                @if($diskonValue > 0)
                                                    <span class="old">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                @endif
                                            </h4>
                                        </div>
                                        @if($topProdukSection && $topProdukSection->is_new)
                                            <span class="badge-skew">Baru</span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="hot-deal__item text-center">
                                        <p>Tidak ada produk</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero end -->

        <!-- feature start -->
        <div class="feature pt-40 pb-30">
            <div class="container">
                <div class="feature__wrap ul_li">
                    <div class="feature__item ul_li">
                        <div class="icon">
                            <img src="{{ asset('web') }}/assets/img/icon/feat_01.svg" alt="Pelayanan Terbaik">
                        </div>
                        <div class="content">
                            <h3>Pelayanan Terbaik</h3>
                            <p>Kami selalu memberikan pelayanan terbaik untuk menjaga kepuasan pelanggan</p>
                        </div>
                    </div>
                    <div class="feature__item ul_li">
                        <div class="icon">
                            <img src="{{ asset('web') }}/assets/img/icon/feat_02.svg" alt="Produk Berkualitas">
                        </div>
                        <div class="content">
                            <h3>Produk Berkualitas</h3>
                            <p>Hasil cetak yang kami berikan berkualitas tinggi dan memuaskan</p>
                        </div>
                    </div>
                    <div class="feature__item ul_li">
                        <div class="icon">
                            <img src="{{ asset('web') }}/assets/img/icon/feat_03.svg" alt="Proses Cepat">
                        </div>
                        <div class="content">
                            <h3>Proses Cepat</h3>
                            <p>Proses cetak lebih cepat karena menggunakan mesin terbaik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature end -->

        <!-- tab product start -->
        <div class="tab-product pt-40 pb-40">
            <div class="container">
                <div class="product__nav-wrap ul_li_between mb-20">
                    <h2 class="section-heading"><span>Hot <span>New Arrival</span> You May Like</span></h2>
                    <ul class="product__nav rd-tab-nav nav nav-tabs" id="vd-myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="vd-tab-01" data-bs-toggle="tab" data-bs-target="#vd-tab1"
                                type="button" role="tab" aria-controls="vd-tab1"
                                aria-selected="true">Recent</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="vd-tab-02" data-bs-toggle="tab" data-bs-target="#vd-tab2"
                                type="button" role="tab" aria-controls="vd-tab2" aria-selected="false">Best
                                Seller</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="vd-tab-03" data-bs-toggle="tab" data-bs-target="#vd-tab3"
                                type="button" role="tab" aria-controls="vd-tab3" aria-selected="false">Top</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="vd-tab-05" data-bs-toggle="tab" data-bs-target="#vd-tab5"
                                type="button" role="tab" aria-controls="vd-tab5" aria-selected="false">Top
                                rating</button>
                        </li>
                    </ul>
                </div>
                <div class="vd-products">
                    <div class="tab-content tab_has_slider" id="vd-myTabContent">
                        <div class="tab-pane fade {{ $recentProduk->isNotEmpty() ? 'show active' : '' }}" id="vd-tab1" role="tabpanel" aria-labelledby="vd-tab-01">
                            <div class="tab-product__slide tx-arrow">
                                @php
                                    $recentSection = $sections->get('Recent');
                                @endphp
                                @forelse($recentProduk->take(8) as $produk)
                                    @php
                                        $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                            ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                            : asset('web/assets/img/product/img_01.png');
                                        $diskonValue = 0;
                                        if ($recentSection && $recentSection->discount_percentage > 0) {
                                            $diskonValue = $recentSection->discount_percentage;
                                        } elseif ($produk->diskon > 0) {
                                            $diskonValue = $produk->diskon;
                                        }
                                        $hargaDiskon = $diskonValue > 0 ? $produk->harga - ($produk->harga * $diskonValue / 100) : $produk->harga;
                                    @endphp
                                    <div class="tab-product__item tx-product text-center" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="thumb" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                            <a href="{{ route('shop.detail', $produk->slug) }}">
                                                <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                            </a>
                                        </div>
                                        <div class="content" style="margin-top: 10px; width: 100%;">
                                            <h3 class="title" style="white-space: normal; overflow: visible;">
                                                <a href="{{ route('shop.detail', $produk->slug) }}">{{ Str::limit($produk->judul, 50) }}</a>
                                            </h3>
                                            <span class="price">
                                                Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                                @if($diskonValue > 0)
                                                    - <span class="old-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        @if($recentSection && $recentSection->is_new)
                                            <span class="badge-skew">New</span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p>Tidak ada produk tersedia</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vd-tab2" role="tabpanel" aria-labelledby="vd-tab-02">
                            <div class="tab-product__slide tx-arrow">
                                @php
                                    $bestSellerSection = $sections->get('Best Seller');
                                @endphp
                                @forelse($bestSellerProduk->take(8) as $produk)
                                    @php
                                        $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                            ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                            : asset('web/assets/img/product/img_01.png');
                                        $diskonValue = 0;
                                        if ($bestSellerSection && $bestSellerSection->discount_percentage > 0) {
                                            $diskonValue = $bestSellerSection->discount_percentage;
                                        } elseif ($produk->diskon > 0) {
                                            $diskonValue = $produk->diskon;
                                        }
                                        $hargaDiskon = $diskonValue > 0 ? $produk->harga - ($produk->harga * $diskonValue / 100) : $produk->harga;
                                    @endphp
                                    <div class="tab-product__item tx-product text-center" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="thumb" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                            <a href="{{ route('shop.detail', $produk->slug) }}">
                                                <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                            </a>
                                        </div>
                                        <div class="content" style="margin-top: 10px; width: 100%;">
                                            <h3 class="title" style="white-space: normal; overflow: visible;">
                                                <a href="{{ route('shop.detail', $produk->slug) }}">{{ Str::limit($produk->judul, 50) }}</a>
                                            </h3>
                                            <span class="price">
                                                Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                                @if($diskonValue > 0)
                                                    - <span class="old-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        <ul class="product__action">
                                            <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                                            <li><a href="#!"><i class="far fa-shopping-basket"></i></a></li>
                                            <li><a href="#!"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        @if($bestSellerSection && $bestSellerSection->is_new)
                                            <span class="badge-skew">New</span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p>Tidak ada produk tersedia</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vd-tab3" role="tabpanel" aria-labelledby="vd-tab-03">
                            <div class="tab-product__slide tx-arrow">
                                @php
                                    $topSection = $sections->get('Top');
                                @endphp
                                @forelse($topProduk->take(8) as $produk)
                                    @php
                                        $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                            ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                            : asset('web/assets/img/product/img_01.png');
                                        $diskonValue = 0;
                                        if ($topSection && $topSection->discount_percentage > 0) {
                                            $diskonValue = $topSection->discount_percentage;
                                        } elseif ($produk->diskon > 0) {
                                            $diskonValue = $produk->diskon;
                                        }
                                        $hargaDiskon = $diskonValue > 0 ? $produk->harga - ($produk->harga * $diskonValue / 100) : $produk->harga;
                                    @endphp
                                    <div class="tab-product__item tx-product text-center" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="thumb" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                            <a href="{{ route('shop.detail', $produk->slug) }}">
                                                <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                            </a>
                                        </div>
                                        <div class="content" style="margin-top: 10px; width: 100%;">
                                            <h3 class="title" style="white-space: normal; overflow: visible;">
                                                <a href="{{ route('shop.detail', $produk->slug) }}">{{ Str::limit($produk->judul, 50) }}</a>
                                            </h3>
                                            <span class="price">
                                                Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                                @if($diskonValue > 0)
                                                    - <span class="old-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        <ul class="product__action">
                                            <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                                            <li><a href="#!"><i class="far fa-shopping-basket"></i></a></li>
                                            <li><a href="#!"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        @if($topSection && $topSection->is_new)
                                            <span class="badge-skew">New</span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p>Tidak ada produk tersedia</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vd-tab5" role="tabpanel" aria-labelledby="vd-tab-05">
                            <div class="tab-product__slide tx-arrow">
                                @php
                                    $topRatingSection = $sections->get('Top Rating');
                                @endphp
                                @forelse($topRatingProduk->take(8) as $produk)
                                    @php
                                        $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                            ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                            : asset('web/assets/img/product/img_01.png');
                                        $diskonValue = 0;
                                        if ($topRatingSection && $topRatingSection->discount_percentage > 0) {
                                            $diskonValue = $topRatingSection->discount_percentage;
                                        } elseif ($produk->diskon > 0) {
                                            $diskonValue = $produk->diskon;
                                        }
                                        $hargaDiskon = $diskonValue > 0 ? $produk->harga - ($produk->harga * $diskonValue / 100) : $produk->harga;
                                    @endphp
                                    <div class="tab-product__item tx-product text-center" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="thumb" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                            <a href="{{ route('shop.detail', $produk->slug) }}">
                                                <img src="{{ $gambarProduk }}" alt="{{ $produk->judul }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                            </a>
                                        </div>
                                        <div class="content" style="margin-top: 10px; width: 100%;">
                                            <h3 class="title" style="white-space: normal; overflow: visible;">
                                                <a href="{{ route('shop.detail', $produk->slug) }}">{{ Str::limit($produk->judul, 50) }}</a>
                                            </h3>
                                            <span class="price">
                                                Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                                @if($diskonValue > 0)
                                                    - <span class="old-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        <ul class="product__action">
                                            <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                                            <li><a href="#!"><i class="far fa-shopping-basket"></i></a></li>
                                            <li><a href="#!"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        @if($topRatingSection && $topRatingSection->is_new)
                                            <span class="badge-skew">New</span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p>Tidak ada produk tersedia</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tab product end -->

        <!-- rd slide product start -->
        <div class="rd-slide-product">
            <div class="container">
                <div class="row mt-none-30">
                    <div class="col-lg-3 mt-30">
                        <div class="product-category" data-background="{{ asset('web') }}/assets/img/bg/cat_bg.jpg">
                            <h2 class="section-heading mb-25"><span><span>Kategori</span></span></h2>
                            <ul class="list-unstyled">
                                @forelse($kategoris->take(10) as $index => $kategori)
                                    @php
                                        $hasChildren = $kategori->produks->count() > 0;
                                        $iconIndex = ($index % 10) + 1;
                                        $iconPath = asset('web/assets/img/icon/iconcategory.png');
                                    @endphp
                                    <li class="{{ $hasChildren ? 'cat-item-has-children' : '' }}">
                                        <a href="{{ route('shop', ['kategori' => $kategori->id]) }}">{{ $kategori->nama_kategori }}</a>
                                            <!-- <img src="{{ $iconPath }}" alt="{{ $kategori->nama_kategori }}"> -->
                                    </li>
                                @empty
                                    <li><a href="{{ route('shop') }}">Tidak ada kategori</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 mt-30">
                        <div class="rd-slide-products">
                            <h2 class="section-heading mb-25"><span>Trending Product</span></h2>
                            <div class="rd-product__slide tx-arrow">
                                @php
                                    $allProduks = collect();
                                    foreach ($produkPerKategori as $item) {
                                        $allProduks = $allProduks->merge($item['produks']);
                                    }
                                    $allProduks = $allProduks->unique('id')->take(20);
                                    $produksChunked = $allProduks->chunk(2);
                                @endphp
                                @forelse($produksChunked as $produks)
                                    <div class="rd-product__slide-item">
                                        @foreach($produks as $produk)
                                            @php
                                                $gambarProduk = is_array($produk->gambar_produk) && !empty($produk->gambar_produk) 
                                                    ? asset('produk/gambar/' . $produk->gambar_produk[0]) 
                                                    : asset('web/assets/img/product/img_07.png');
                                                $hargaDiskon = $produk->diskon > 0 ? $produk->harga - ($produk->harga * $produk->diskon / 100) : $produk->harga;
                                            @endphp
                                            <div class="product__item">
                                                <div class="product__img text-center pos-rel mb-20" style="width:100%; display:flex; justify-content:center; align-items:center;">
                                                    <a href="{{ route('shop.detail', $produk->slug) }}">
                                                        <img 
                                                            src="{{ $gambarProduk }}" 
                                                            alt="{{ $produk->judul }}" 
                                                            class="img-fluid" 
                                                            style="max-width: 100%; height: auto; display: block; margin: 0 auto;"
                                                        >
                                                    </a>
                                                </div>
                                                <div class="product__content" style="text-align:center;">
                                                    <h2 class="product__title" style="margin-bottom:8px; white-space: normal; overflow: visible;">
                                                        <a href="{{ route('shop.detail', $produk->slug) }}">{{ Str::limit($produk->judul, 50) }}</a>
                                                    </h2>
                                                    <h4 class="product__price">
                                                        <span class="new">Rp {{ number_format($hargaDiskon, 0, ',', '.') }}</span> 
                                                        @if($produk->diskon > 0)
                                                            <span class="old">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                        @endif
                                                    </h4>
                                                </div>
                                                @if($topRatingSection && $topRatingSection->is_new)
                                                    <span class="badge-skew">New</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @empty
                                    <div class="rd-product__slide-item">
                                        <div class="col-12 text-center py-5">
                                            <p>Tidak ada produk tersedia</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rd slide product end -->

      

      

    </main>
@endsection
