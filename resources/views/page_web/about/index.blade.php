@extends('template_web.layout')
@section('content')
    <main>
        
        <!-- breadcrumb start -->
        <section class="breadcrumb-area">
            <div class="container">
                <div class="radios-breadcrumb breadcrumbs">
                    <ul class="list-unstyled d-flex align-items-center">
                        <li class="radiosbcrumb-item radiosbcrumb-begin">
                            <a href="{{ route('landing') }}"><span>Beranda</span></a>
                        </li>
                        <li class="radiosbcrumb-item radiosbcrumb-end">
                            <span>Tentang Kami</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->

        <!-- about start -->
        <section class="about">
            <div class="container">
                <div class="row g-0 align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about__img">
                            @if(isset($profil) && $profil->gambar)
                                <img src="{{ asset('profil/gambar/' . $profil->gambar) }}" alt="{{ $profil->nama_perusahaan ?? 'Tentang Kami' }}" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                            @else
                                <img src="{{ asset('web') }}/assets/img/about/img_01.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="about__content pl-70">
                            <h2>
                                @if(isset($profil) && $profil->nama_perusahaan)
                                    {{ $profil->nama_perusahaan }}
                                @else
                                    Lebih Dari 25+ Tahun Kami Menyediakan Layanan Terbaik
                                @endif
                            </h2>
                            <p>
                                @if(isset($profil) && $profil->alamat_perusahaan)
                                    {{ $profil->alamat_perusahaan }}
                                @else
                                    Kami menghadirkan solusi yang praktis dan hasil terbaik untuk kebutuhan Anda. Dengan pengalaman bertahun-tahun, kami siap membantu mewujudkan kebutuhan impian Anda.
                                @endif
                            </p>
                            <div class="row mt-6">
                                <div class="col-lg-6 mt-30">
                                    <div class="about__info-box d-flex">
                                        <span class="icon"><img src="{{ asset('web') }}/assets/img/icon/about_01.svg" alt=""></span>
                                        <div class="content">
                                            <h4>Layanan Profesional</h4>
                                            <p>Kami menyediakan layanan profesional dengan kualitas terbaik untuk memenuhi kebutuhan Anda.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-30">
                                    <div class="about__info-box d-flex">
                                        <span class="icon"><img src="{{ asset('web') }}/assets/img/icon/about_01.svg" alt=""></span>
                                        <div class="content">
                                            <h4>Tim Berpengalaman</h4>
                                            <p>Tim kami terdiri dari profesional berpengalaman yang siap membantu Anda.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="about__list list-unstyled mt-25">
                                <li>Kualitas produk dan layanan terjamin</li>
                                <li>Pelayanan customer service yang responsif</li>
                                <li>Harga kompetitif dan transparan</li>
                            </ul>
                            <div class="about__btn mt-30">
                                <a class="thm-btn thm-btn__2" href="{{ route('kontak.index') }}">
                                    <span class="btn-wrap">
                                        <span>Hubungi Kami</span>
                                        <span>Hubungi Kami</span>
                                    </span>
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0 align-items-center flex-row-reverse md-mt-30">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about__img">
                            @if(isset($profil) && $profil->latitude && $profil->longitude)
                                <div id="map" style="height: 500px; width: 100%;"></div>
                            @else
                                <img src="{{ asset('web') }}/assets/img/about/img_03.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="about__content pr-55">
                            <h3>Visi & Misi Kami</h3>
                            <p>Kami berkomitmen untuk memberikan layanan terbaik kepada pelanggan dengan fokus pada kualitas, inovasi, dan kepuasan pelanggan. Tim kami bekerja keras untuk memastikan setiap produk dan layanan yang kami berikan memenuhi standar tertinggi.</p>
                            <div class="about__video mt-35 ul_li">
                                <div class="about__video-img pos-rel">
                                    @if(isset($profil) && $profil->gambar)
                                        <img src="{{ asset('profil/gambar/' . $profil->gambar) }}" alt="{{ $profil->nama_perusahaan ?? 'Tentang Kami' }}" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                    @else
                                        <img src="{{ asset('web') }}/assets/img/about/img_02.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                    @endif
                                </div>
                                <div class="about__video-content">
                                    <h4>Mengapa Memilih Kami?</h4>
                                    <p>Kami memahami pentingnya kualitas dan kepuasan pelanggan dalam setiap layanan yang kami berikan.</p>
                                    <ul class="about__list list-unstyled mt-15">
                                        <li>Kualitas produk terjamin</li>
                                        <li>Harga kompetitif</li>
                                        <li>Pelayanan customer yang responsif</li>
                                        <li>Pengalaman bertahun-tahun</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about end -->

        <!-- about info start -->
        <section class="about-info pt-75 pb-100">
            <div class="container">
                <div class="about-info__wrap">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-5">
                            <div class="about-info__box">
                                <div class="about-info__item d-flex">
                                    <span class="number">01</span>
                                    <div class="content">
                                        <h4>Tingkat Kesuksesan Tertinggi</h4>
                                        <p>Kami memiliki tingkat kesuksesan yang tinggi dalam memenuhi kebutuhan pelanggan dengan kualitas terbaik.</p>
                                    </div>
                                </div>
                                <div class="about-info__item d-flex">
                                    <span class="number">02</span>
                                    <div class="content">
                                        <h4>Kerja Tim yang Efektif</h4>
                                        <p>Tim kami bekerja sama dengan efektif untuk memberikan hasil terbaik bagi pelanggan.</p>
                                    </div>
                                </div>
                                <div class="about-info__item d-flex">
                                    <span class="number">03</span>
                                    <div class="content">
                                        <h4>Kami Mengembangkan Bisnis</h4>
                                        <p>Kami terus berkembang dan berinovasi untuk memberikan layanan yang lebih baik.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7">
                            <div class="about-info__tab-wrap pl-150">
                                <h2>Bagaimana Kami Menghadapi Tantangan</h2>
                                <p>Kami menganalisis model bisnis saat ini, menilai posisi kompetitif perusahaan di pasar, kondisi keuangan, serta semua kemungkinan yang ada untuk memberikan solusi terbaik.</p>
                                <div class="about-info__tab mt-25">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tentang Kami</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tujuan</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Keunggulan</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane animated fadeInUp show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="about-info__tab-content">
                                                <ul class="about-info__tab-list list-unstyled">
                                                    <li>Kami berkomitmen memberikan layanan terbaik</li>
                                                    <li>Fokus pada kualitas dan kepuasan pelanggan</li>
                                                    <li>Tim profesional berpengalaman</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane animated fadeInUp" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="about-info__tab-content">
                                                <ul class="about-info__tab-list list-unstyled">
                                                    <li>Menyediakan produk dan layanan berkualitas tinggi</li>
                                                    <li>Membangun hubungan jangka panjang dengan pelanggan</li>
                                                    <li>Terus berinovasi dan berkembang</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane animated fadeInUp" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="about-info__tab-content">
                                                <ul class="about-info__tab-list list-unstyled">
                                                    <li>Kualitas produk terjamin</li>
                                                    <li>Harga kompetitif dan transparan</li>
                                                    <li>Pelayanan customer service yang responsif</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about info end -->
        
    </main>

@endsection

@section('script')
@if(isset($profil) && $profil->latitude && $profil->longitude)
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // Inisialisasi Leaflet untuk menampilkan lokasi
    var map = L.map('map').setView([{{ $profil->latitude }}, {{ $profil->longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Menambahkan marker untuk lokasi perusahaan
    var marker = L.marker([{{ $profil->latitude }}, {{ $profil->longitude }}]).addTo(map);
    
    // Menambahkan popup dengan informasi perusahaan
    marker.bindPopup(`
        <div class="text-center">
            <h6 class="mb-2">{{ $profil->nama_perusahaan ?? 'Perusahaan' }}</h6>
            <p class="mb-1"><small>{{ $profil->alamat_perusahaan ?? '' }}</small></p>
            @if($profil->no_telp_perusahaan)
            <p class="mb-0"><small>{{ $profil->no_telp_perusahaan }}</small></p>
            @endif
        </div>
    `).openPopup();

    // Menambahkan circle untuk area sekitar
    var circle = L.circle([{{ $profil->latitude }}, {{ $profil->longitude }}], {
        color: '#007bff',
        fillColor: '#007bff',
        fillOpacity: 0.1,
        radius: 500
    }).addTo(map);
</script>
@endif
@endsection
