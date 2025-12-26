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
                            <span>Kontak</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->

        <!-- contact info start -->
        <section class="contact-info">
            <div class="container">
                <div class="row justify-content-center mt-none-30">
                    @if($profil && $profil->email_perusahaan)
                    <div class="col-xl-3 col-lg-4 col-md-6 mt-30">
                        <div class="contact-info__item d-flex">
                            <span class="icon"><img src="{{ asset('web') }}/assets/img/icon/mail.svg" alt=""></span>
                            <div class="content">
                                <h3>Email</h3>
                                <a href="mailto:{{ $profil->email_perusahaan }}">{{ $profil->email_perusahaan }}</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profil && $profil->alamat_perusahaan)
                    <div class="col-xl-3 col-lg-4 col-md-6 mt-30">
                        <div class="contact-info__item active d-flex">
                            <span class="icon"><img src="{{ asset('web') }}/assets/img/icon/location.svg" alt=""></span>
                            <div class="content">
                                <h3>Alamat</h3>
                                <p>{{ $profil->alamat_perusahaan }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profil && $profil->no_telp_perusahaan)
                    <div class="col-xl-3 col-lg-4 col-md-6 mt-30">
                        <div class="contact-info__item d-flex">
                            <span class="icon"><img src="{{ asset('web') }}/assets/img/icon/call-2.svg" alt=""></span>
                            <div class="content">
                                <h3>Nomor Telepon</h3>
                                <a href="tel:{{ $profil->no_telp_perusahaan }}">{{ $profil->no_telp_perusahaan }}</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profil && $profil->email_perusahaan)
                    <div class="col-xl-3 col-lg-4 col-md-6 mt-30">
                        <div class="contact-info__item d-flex">
                            <span class="icon"><img src="{{ asset('web') }}/assets/img/icon/c_us.svg" alt=""></span>
                            <div class="content">
                                <h3>Media Sosial</h3>
                                <a href="{{ $profil->instagram_perusahaan }}" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                                <a href="{{ $profil->facebook_perusahaan }}" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>

                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- contact info end -->

        <!-- contact start -->
        <section class="contact pt-90">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="contact-img text-center">
                            @if($profil && $profil->logo_perusahaan)
                                <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="{{ $profil->nama_perusahaan ?? 'Kontak' }}" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                            @else
                                <img src="{{ asset('web') }}/assets/img/contact/img_01.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-from__wrap pl-55">
                            <form class="contact-from" action="{{ route('kontak.store') }}" method="POST" id="kontakForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="contact-from__field">
                                            <input type="text" 
                                                   name="nama" 
                                                   placeholder="Nama Anda*"
                                                   class="@error('nama') is-invalid @enderror"
                                                   value="{{ old('nama') }}"
                                                   required>
                                            @error('nama')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-from__field">
                                            <input type="email" 
                                                   name="email" 
                                                   placeholder="Email Anda*"
                                                   class="@error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}"
                                                   required>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-from__field">
                                            <input type="text" 
                                                   name="subjek" 
                                                   placeholder="Subjek*"
                                                   class="@error('subjek') is-invalid @enderror"
                                                   value="{{ old('subjek') }}"
                                                   required>
                                            @error('subjek')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-from__field">
                                            <input type="text" 
                                                   placeholder="Website (Opsional)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="contact-from__field">
                                            <textarea name="pesan" 
                                                      id="message" 
                                                      cols="30" 
                                                      rows="10" 
                                                      placeholder="Tulis Pesan Anda*"
                                                      class="@error('pesan') is-invalid @enderror"
                                                      required>{{ old('pesan') }}</textarea>
                                            @error('pesan')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="h-captcha" data-sitekey="{{ $hcaptchaSiteKey ?? '3c982cb8-bc8a-4204-bfe2-2178e2ea53a8' }}"></div>
                                        @error('h-captcha-response')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="contact-from__chekbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox">
                                        <label for="checkbox">Simpan nama, email, dan website saya di browser ini untuk komentar berikutnya.</label>
                                    </div>
                                    <div class="contact-from__btn mt-35">
                                        <button type="submit" class="thm-btn thm-btn__2" id="submitBtn">
                                            <span class="btn-wrap">
                                                <span>Kirim Pesan</span>
                                                <span>Kirim Pesan</span>
                                            </span>
                                            <i class="far fa-long-arrow-right"></i>
                                        </button>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact end -->

        <!-- Map Section Start -->
        @if($profil && ($profil->latitude && $profil->longitude || $profil->alamat_perusahaan))
        <section class="contact-info-area pt-50 pb-80">
            <div class="container">
                <div class="row mt-none-30">
                    @if($profil->latitude && $profil->longitude)
                    <div class="col-12 mt-30">
                        <div id="map" style="height: 500px; width: 100%; border-radius: 10px; overflow: hidden;"></div>
                    </div>
                    @elseif($profil->alamat_perusahaan)
                    <div class="col-12 mt-30">
                        <iframe 
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dS6fr4Jb-1qFhE&q={{ urlencode($profil->alamat_perusahaan) }}" 
                            style="border:0; width: 100%; height: 500px; border-radius: 10px;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

    </main>

@endsection

@section('script')
<!-- hCaptcha Script -->
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

@if($profil && $profil->latitude && $profil->longitude)
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

<script>
    // Disable submit button until hCaptcha is verified
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('kontakForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            const hCaptchaResponse = form.querySelector('[name="h-captcha-response"]');
            if (!hCaptchaResponse || !hCaptchaResponse.value) {
                e.preventDefault();
                alert('Silakan verifikasi hCaptcha terlebih dahulu.');
                return false;
            }
        });
    });
</script>
@endsection
