@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-asisten">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manage-layanan.index') }}">Layanan</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Data Layanan</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Layanan</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Data Layanan</h5>
              <div>
                <a href="{{ route('manage-layanan.edit', $manageLayanan->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('manage-layanan.index') }}" class="btn btn-light">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Judul Layanan</h6>
                    <p class="mb-0">{{ $manageLayanan->judul_layanan }}</p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Gambar Layanan</h6>
                    @if($manageLayanan->gambar_layanan)
                      <img src="{{ asset('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan) }}" alt="{{ $manageLayanan->judul_layanan }}" class="img-fluid rounded" style="max-width: 500px; max-height: 500px; object-fit: cover;">
                    @else
                      <p class="text-muted mb-0">Tidak ada gambar</p>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Deskripsi Layanan</h6>
                    <p class="mb-0">{!! nl2br(e($manageLayanan->deskripsi_layanan)) !!}</p>
                  </div>
                </div>
              </div>

              <!-- FAQ Section -->
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold mb-3">FAQ (Frequently Asked Questions)</h6>
                    @if($manageLayanan->faq && is_array($manageLayanan->faq) && count($manageLayanan->faq) > 0)
                      <div class="accordion" id="faqAccordion">
                        @foreach($manageLayanan->faq as $index => $faq)
                          <div class="accordion-item mb-2">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                              <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                <strong>{{ $index + 1 }}. {{ $faq['pertanyaan'] ?? 'Pertanyaan tidak tersedia' }}</strong>
                              </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                              <div class="accordion-body">
                                {!! nl2br(e($faq['jawaban'] ?? 'Jawaban tidak tersedia')) !!}
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    @else
                      <div class="alert alert-info">
                        <i class="bx bx-info-circle"></i> Belum ada FAQ yang ditambahkan.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
