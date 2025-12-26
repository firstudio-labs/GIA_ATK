@extends('template_admin.layout')
@section('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
@endsection
@section('content')
<section class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profil Perusahaan</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Data Profil</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Profil</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Informasi Perusahaan -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="bx bx-building me-2"></i>Detail Data Profil</h5>
              <div>
                <a href="{{ route('profil-perusahaan.edit', $profil) }}" class="btn btn-warning btn-sm">
                  <i class="bx bx-edit me-1"></i>Edit
                </a>
                <a href="{{ route('profil-perusahaan.index') }}" class="btn btn-light btn-sm">
                  <i class="bx bx-arrow-back me-1"></i>Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Logo dan Info Utama -->
                <div class="col-md-4 text-center mb-4">
                  <div class="border rounded p-3 bg-light">
                    <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" 
                         alt="Logo Perusahaan" 
                         class="img-fluid rounded" 
                         style="max-width: 150px; max-height: 150px; object-fit: contain;">
                  </div>
                </div>
                
                <div class="col-md-8">
                  <h4 class="text-primary mb-3">{{ $profil->nama_perusahaan }}</h4>
                  
                  <div class="row">
                    <div class="col-sm-6 mb-3">
                      <div class="d-flex align-items-center">
                        <i class="bx bx-phone text-success me-2"></i>
                        <div>
                          <small class="text-muted d-block">No. Telepon</small>
                          <strong>{{ $profil->no_telp_perusahaan }}</strong>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-6 mb-3">
                      <div class="d-flex align-items-center">
                        <i class="bx bx-envelope text-info me-2"></i>
                        <div>
                          <small class="text-muted d-block">Email</small>
                          <strong>{{ $profil->email_perusahaan }}</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="d-flex align-items-start">
                      <i class="bx bx-map text-warning me-2 mt-1"></i>
                      <div>
                        <small class="text-muted d-block">Alamat</small>
                        <strong>{{ $profil->alamat_perusahaan }}</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Media Sosial -->
              <div class="row mt-4">
                <div class="col-12">
                  <h6 class="text-muted mb-3"><i class="bx bx-share-alt me-2"></i>Media Sosial</h6>
                  <div class="d-flex flex-wrap gap-2">
                    @if($profil->instagram_perusahaan)
                      <a href="{{ $profil->instagram_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-danger btn-sm" title="Instagram">
                        <i class="fab fa-instagram"></i>
                      </a>
                    @endif
                    @if($profil->facebook_perusahaan)
                      <a href="{{ $profil->facebook_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-primary btn-sm" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                    @endif
                    @if($profil->twitter_perusahaan)
                      <a href="{{ $profil->twitter_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-info btn-sm" title="Twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                    @endif
                    @if($profil->tiktok_perusahaan)
                      <a href="{{ $profil->tiktok_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-primary btn-sm" title="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z"/></svg>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Peta Lokasi -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h6 class="mb-0"><i class="bx bx-map me-2"></i>Lokasi Perusahaan</h6>
            </div>
            <div class="card-body">
              @if($profil->latitude && $profil->longitude)
                <div id="map" style="height: 300px; width: 100%; border-radius: 5px;"></div>
                <div class="mt-3">
                  <div class="row text-center">
                    <div class="col-6">
                      <small class="text-muted d-block">Latitude</small>
                      <strong class="text-primary">{{ $profil->latitude }}</strong>
                    </div>
                    <div class="col-6">
                      <small class="text-muted d-block">Longitude</small>
                      <strong class="text-primary">{{ $profil->longitude }}</strong>
                    </div>
                  </div>
                </div>
              @else
                <div class="text-center py-4">
                  <i class="bx bx-map-pin text-muted" style="font-size: 3rem;"></i>
                  <p class="text-muted mt-2">Lokasi belum ditentukan</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')  
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <script>
        @if($profil->latitude && $profil->longitude)
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
                <h6 class="mb-2">{{ $profil->nama_perusahaan }}</h6>
                <p class="mb-1"><small>{{ $profil->alamat_perusahaan }}</small></p>
                <p class="mb-0"><small>{{ $profil->no_telp_perusahaan }}</small></p>
            </div>
        `).openPopup();

        // Menambahkan circle untuk area sekitar
        var circle = L.circle([{{ $profil->latitude }}, {{ $profil->longitude }}], {
            color: '#007bff',
            fillColor: '#007bff',
            fillOpacity: 0.1,
            radius: 500
        }).addTo(map);
        @endif
    </script>
@endsection