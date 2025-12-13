    <!-- footer start -->
    @php
        $profil = \App\Models\Profil::first();
        $kategoris = \App\Models\ManageKategori::with('produks')->whereHas('produks', function($query) {
            $query->where('status', 'aktif');
        })->get();
    @endphp
    <footer class="footer" data-background="{{ asset('web') }}/assets/img/bg/footer_bg.jpg">
        <div class="newslater newslater__border pt-30 pb-30">
            <div class="container">
                <div class="newslater__two ul_li">
                    <div class="newslater__content">
                        <h2 class="title">Kami siap untuk <span>membantu</span></h2>
                        <p>Untuk informasi, konsultasikan dengan tim ahli kami</p>
                    </div>
                    <form class="newslater__form" action="{{ route('kontak.index') }}" method="GET">
                        <input placeholder="Masukkan Email Anda" type="email" name="email">
                        <button type="submit">Hubungi Kami</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer__main pt-90 pb-90">
                <div class="row mt-none-40">
                    <div class="footer__widget col-lg-3 col-md-6 mt-40">
                        <div class="footer__logo mb-20">
                            <a href="{{ route('landing') }}">
                                @if($profil && $profil->logo_perusahaan)
                                    <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="{{ $profil->nama_perusahaan ?? 'Logo' }}" style="max-height: 60px;">
                                @else
                                    <img src="{{ asset('web') }}/assets/img/logo/logo.svg" alt="Logo">
                                @endif
                            </a>
                        </div>
                        @if($profil && $profil->alamat_perusahaan)
                            <p>{{ $profil->alamat_perusahaan }}</p>
                        @endif
                        <ul class="footer__info mt-30">
                            @if($profil && $profil->no_telp_perusahaan)
                                <li><i class="fas fa-phone"></i>{{ $profil->no_telp_perusahaan }}</li>
                            @endif
                            @if($profil && $profil->email_perusahaan)
                                <li><i class="far fa-envelope"></i>{{ $profil->email_perusahaan }}</li>
                            @endif
                        </ul>
                    </div>
                   
                    <div class="footer__widget col-lg-3 col-md-6 mt-40">
                        
                    </div>

                    <div class="footer__widget col-lg-3 col-md-6 mt-40">
                        <h2 class="title">Tautan Cepat</h2>
                        <ul class="quick-links">
                            <li><a href="{{ route('landing') }}">Beranda</a></li>
                            <li><a href="{{ route('kontak.index') }}">Kontak</a></li>
                            @auth
                                <li><a href="{{ route('profil') }}">Profil Saya</a></li>
                                <li><a href="{{ route('riwayat-pesanan.index') }}">Riwayat Pesanan</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Login / Daftar</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="footer__widget col-lg-3 col-md-6 mt-40">
                        <h2 class="title">Kategori Produk</h2>
                        <ul class="quick-links">
                            @if($kategoris->isNotEmpty())
                                @foreach($kategoris->take(7) as $kategori)
                                    <li><a href="{{ route('shop', ['kategori' => $kategori->id]) }}">{{ $kategori->nama_kategori }}</a></li>
                                @endforeach
                            @else
                                <li><a href="{{ route('shop') }}">Semua Produk</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__bottom ul_li_center">
                <div class="footer__copyright mt-15">
                    &copy; {{ date('Y') }} 
                    @if($profil && $profil->nama_perusahaan)
                        <a href="{{ route('landing') }}">{{ $profil->nama_perusahaan }}</a>
                    @else
                        <a href="{{ route('landing') }}">GIA Marketplace</a>
                    @endif
                    . All Rights Reserved.
                </div>
                <div class="footer__social mt-15">
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
    </footer>
    <!-- footer end -->