 <!-- header start -->
 @php
    $profil = \App\Models\Profil::first();
    $ownerWhatsapp = \App\Models\OwnerWhatsapp::first();
    $kategoris = \App\Models\ManageKategori::with('produks')->whereHas('produks', function($query) {
        $query->where('status', 'aktif');
    })->get();
 @endphp
 <header class="header header__style-one">
    <div class="header__top-info-wrap d-none d-lg-block">
        <div class="container">
            <div class="header__top-info ul_li_between mt-none-10">
                <ul class="ul_li mt-10">
                    {{-- @if($profil && $profil->alamat_perusahaan)
                        <li><i class="far fa-map-marker-alt"></i>{{ $profil->alamat_perusahaan }}</li>
                    @endif --}}
                    @if($profil && $profil->no_telp_perusahaan)
                        <li><i class="fas fa-phone"></i>{{ $profil->no_telp_perusahaan }}</li>
                    @elseif($ownerWhatsapp && $ownerWhatsapp->no_wa)
                        <li><i class="fas fa-phone"></i><a href="https://wa.me/{{ $ownerWhatsapp->no_wa }}" target="_blank" class="text-white">{{ $ownerWhatsapp->no_wa }}</a></li>
                    @endif
                    @if($profil && $profil->nama_perusahaan)
                        <li><i></i>Welcome to {{ $profil->nama_perusahaan }}</li>
                    @endif
                </ul>
                <div class="header__top-right ul_li mt-10">
                    <div class="date">
                        <i class="fal fa-calendar-alt"></i> {{ \Carbon\Carbon::now()->format('l, F d, Y') }}
                    </div>
                    <style>
                        .header__social a i, .header__social a .tiktok-icon {
                            font-size: 18px;
                            width: 18px;
                            height: 18px;
                            line-height: 18px;
                            display: inline-block;
                            vertical-align: middle;
                        }
                        .header__social a .tiktok-icon svg {
                            width: 18px;
                            height: 18px;
                            vertical-align: middle;
                        }
                        .header__social a {
                            margin-right: 8px;
                        }
                    </style>
                    <div class="header__social ml-25">
                        @if($profil && $profil->facebook_perusahaan)
                            <a href="{{ $profil->facebook_perusahaan }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($profil && $profil->twitter_perusahaan)
                            <a href="{{ $profil->twitter_perusahaan }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($profil && $profil->instagram_perusahaan)
                            <a href="{{ $profil->instagram_perusahaan }}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($profil && $profil->tiktok_perusahaan)
                            <a href="{{ $profil->tiktok_perusahaan }}" target="_blank">
                                <span class="tiktok-icon" style="display:inline-block; vertical-align:middle;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="18" height="18"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z"/></svg>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="header__middle ul_li_between justify-content-xs-center">
            <div class="header__logo">
                <a href="https://giaprint.id/">
                    @if($profil && $profil->logo_perusahaan)
                        <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="{{ $profil->nama_perusahaan ?? 'Logo' }}" style="max-height: 60px;">
                    @else
                        <img src="{{ asset('web') }}/assets/img/logo/logo.svg" alt="Logo">
                    @endif
                </a>
            </div>
            <form class="header__search-box" action="{{ route('shop') }}" method="GET">
                <div class="select-box">
                    <select id="category" name="kategori">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" name="search" id="search" placeholder="Cari Produk..." value="{{ request('search') }}" />
                <button type="submit"><i class="far fa-search"></i>
                </button>
            </form>
           
            <div class="header__icons ul_li">
               
             
                <div class="cart_btn icon" id="cartIcon">
                    <img src="{{ asset('web') }}/assets/img/icon/shopping_bag.svg" alt="">
                    <span class="count" id="cartCount">
                        @auth
                            {{ \App\Models\Keranjang::where('user_id', Auth::id())->sum('quantity') ?? 0 }}
                        @else
                            0
                        @endauth
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="header__cat-wrap" data-uk-sticky="top: 250; animation: uk-animation-slide-top;">
        <div class="container">
            <div class="header__wrap ul_li_between">
                <div class="header__cat ul_li" >
                    <div class="hamburger_menu">
                        <a href="javascript:void(0);" class="active">
                            <div class="icon bar">
                                <span><i class="fal fa-bars"></i></span>
                            </div>
                        </a>
                    </div>
                    <ul class="category ul_li">
                        @foreach($kategoris->take(6) as $kategori)
                            <li>
                                <a href="{{ route('shop', ['kategori' => $kategori->id]) }}">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            </li>
                        @endforeach
                        @if($kategoris->count() > 6)
                            <li>
                                <a href="{{ route('shop') }}">
                                    <span><i class="fal fa-ellipsis-h"></i></span>
                                    Lainnya
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="login-sign-btn">
                    @auth
                        <a class="thm-btn" href="{{ route('profil') }}">
                            <span class="btn-wrap">
                                <span>{{ Auth::user()->name }}</span>
                                <span>{{ Auth::user()->name }}</span>
                            </span>
                        </a>
                            <a href="/logout" class="thm-btn bg-danger" style="margin-left: 10px;">
                                <span class="btn-wrap">
                                    <span>Logout</span>
                                    <span>Logout</span>
                                </span>
                            </a>
                    @else
                        <a class="thm-btn" href="{{ route('login') }}">
                            <span class="btn-wrap">
                                <span>Login / Sign Up</span>
                                <span>Login / Sign Up</span>
                            </span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search - Only visible on mobile -->
    <div class="header-mobile-search d-lg-none">
        <div class="container">
            <form role="search" method="get" action="{{ route('shop') }}">
                <input type="text" name="search" placeholder="Cari Produk..." value="{{ request('search') }}">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>
        </div>
    </div>

    <style>
        .header-mobile-search {
            background: var(--color-white);
            border-top: 1px solid #eee;
            padding: 15px 0;
        }
        .header-mobile-search form {
            position: relative;
            max-width: 100%;
        }
        .header-mobile-search input {
            width: 100%;
            padding: 12px 50px 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 25px;
            font-size: 14px;
            background: #f8f9fa;
            outline: none;
            transition: all 0.3s ease;
        }
        .header-mobile-search input:focus {
            border-color: var(--color-primary);
            background: var(--color-white);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        .header-mobile-search button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--color-primary);
            color: var(--color-white);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .header-mobile-search button:hover {
            background: var(--color-primary-dark, #0056b3);
            transform: translateY(-50%) scale(1.05);
        }
        .header-mobile-search button i {
            font-size: 16px;
        }
    </style>
</header>
<!-- header end -->

@auth
<script>
    // Update cart count secara dinamis
    function updateCartCount() {
        fetch('{{ route("keranjang.get") }}', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            const cartCountElement = document.getElementById('cartCount');
            if (cartCountElement) {
                const totalQuantity = data.items ? data.items.reduce((sum, item) => sum + item.quantity, 0) : 0;
                cartCountElement.textContent = totalQuantity;
            }
        })
        .catch(error => {
            console.error('Error updating cart count:', error);
        });
    }

    // Update cart count saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });

    // Update cart count saat ada perubahan (event listener untuk custom event)
    document.addEventListener('cartUpdated', function() {
        updateCartCount();
    });
</script>
@endauth