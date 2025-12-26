    <!-- footer start -->
    @php
        $profil = \App\Models\Profil::first();
        $kategoris = \App\Models\ManageKategori::with('produks')
            ->whereHas('produks', function ($query) {
                $query->where('status', 'aktif');
            })
            ->get();
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
                                @if ($profil && $profil->logo_perusahaan)
                                    <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}"
                                        alt="{{ $profil->nama_perusahaan ?? 'Logo' }}" style="max-height: 60px;">
                                @else
                                    <img src="{{ asset('web') }}/assets/img/logo/logo.svg" alt="Logo">
                                @endif
                            </a>
                        </div>
                        @if ($profil && $profil->alamat_perusahaan)
                            <p>{{ $profil->alamat_perusahaan }}</p>
                        @endif
                        <ul class="footer__info mt-30" style="padding-left:0; list-style:none;">
                            @if ($profil && $profil->no_telp_perusahaan)
                                <li class="d-flex align-items-center mb-2" style="word-break: break-all;">
                                    <i class="fas fa-phone me-2" style="min-width:20px;"></i>
                                    <span>{{ $profil->no_telp_perusahaan }}</span>
                                </li>
                            @endif
                            @if ($profil && $profil->email_perusahaan)
                                <li class="d-flex align-items-center mb-2" style="word-break: break-all;">
                                    <i class="far fa-envelope me-2" style="min-width:20px;"></i>
                                    <span>{{ $profil->email_perusahaan }}</span>
                                </li>
                            @endif
                            <li class="d-flex align-items-center mb-2 flex-wrap" style="word-break: break-all;">
                                <img src="https://assets.zonalogo.com/finance/bank-central-asia/bank-central-asia-256.webp"
                                    alt="No Rekening"
                                    style="height:20px; width:auto; margin-right:8px; display:inline;">
                                <span style="font-weight:600;">2521318025</span>
                                <span style="margin-left:8px;">a.n. Imam Rizki Fauzi</span>
                            </li>
                            <li>
                                <small style="color:red; display:block; margin-top:2px; line-height:1.5;">
                                    * Harap tidak melakukan transfer ke rekening lain selain nomor rekening di atas.
                                </small>
                            </li>
                        </ul>
                        <style>
                            @media (max-width: 576px) {
                                .footer__info li {
                                    font-size: 15px;
                                    line-height: 1.6;
                                }

                                .footer__info img {
                                    height: 16px !important;
                                }
                            }
                        </style>
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
                            @if ($kategoris->isNotEmpty())
                                @foreach ($kategoris->take(7) as $kategori)
                                    <li><a
                                            href="{{ route('shop', ['kategori' => $kategori->id]) }}">{{ $kategori->nama_kategori }}</a>
                                    </li>
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
                    @if ($profil && $profil->nama_perusahaan)
                        <a href="{{ route('landing') }}">{{ $profil->nama_perusahaan }}</a>
                    @else
                        <a href="{{ route('landing') }}">GIA Marketplace</a>
                    @endif
                    . All Rights Reserved.
                </div>
                <div class="footer__social mt-15">
                    @if ($profil && $profil->facebook_perusahaan)
                        <a href="{{ $profil->facebook_perusahaan }}" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if ($profil && $profil->twitter_perusahaan)
                        <a href="{{ $profil->twitter_perusahaan }}" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if ($profil && $profil->instagram_perusahaan)
                        <a href="{{ $profil->instagram_perusahaan }}" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if ($profil && $profil->tiktok_perusahaan)
                        <a href="{{ $profil->tiktok_perusahaan }}" target="_blank" class="tiktok-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="18" height="18">
                                <path d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z"/>
                            </svg>
                        </a>
                    @endif
                </div>
                <style>
                    .footer__social a i,
                    .footer__social a .tiktok-icon {
                        font-size: 18px;
                        width: 18px;
                        height: 18px;
                        line-height: 18px;
                        display: inline-block;
                        vertical-align: middle;
                    }
                    .footer__social a .tiktok-icon svg {
                        width: 18px;
                        height: 18px;
                        vertical-align: middle;
                    }
                    .footer__social a {
                        margin-right: 8px;
                    }
                </style>
            </div>
        </div>
    </footer>
    <!-- footer end -->
