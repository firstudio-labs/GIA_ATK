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
                    <div class="header__social ml-25">
                        @if($profil && $profil->facebook_perusahaan)
                            <a href="{{ $profil->facebook_perusahaan }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($profil && $profil->twitter_perusahaan)
                            <a href="{{ $profil->twitter_perusahaan }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($profil && $profil->instagram_perusahaan)
                            <a href="{{ $profil->instagram_perusahaan }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($profil && $profil->linkedin_perusahaan)
                            <a href="{{ $profil->linkedin_perusahaan }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="header__middle ul_li_between justify-content-xs-center">
            <div class="header__logo">
                <a href="{{ route('landing') }}">
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