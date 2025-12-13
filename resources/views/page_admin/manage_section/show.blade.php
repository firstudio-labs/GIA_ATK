@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <style>
        :root{--pri:#4F46E5;--pri-600:#4338CA;--sec:#0EA5E9;--acc:#22C55E;--warn:#F59E0B;--danger:#EF4444;--muted:#6b7280}
        .card{border:0;border-radius:12px}
        .card-header{border-bottom:0;border-top-left-radius:12px;border-top-right-radius:12px;background:linear-gradient(135deg,var(--pri),var(--sec));color:#fff}
        .page-header-title h2{font-weight:700}
        .breadcrumb .breadcrumb-item a{color:var(--pri)}
      </style>
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manage-section.index') }}">Manage Section</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Section</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Section</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Section</h5>
              <div>
                <a href="{{ route('manage-section.edit', $section->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('manage-section.index') }}" class="btn btn-light">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <h6 class="fw-bold">Nama Section</h6>
                    <p class="mb-0">{{ $section->name }}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <h6 class="fw-bold">Diskon</h6>
                    <p class="mb-0">{{ $section->discount_percentage ? $section->discount_percentage.'%' : '-' }}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <h6 class="fw-bold">Badge New</h6>
                    <span class="badge {{ $section->is_new ? 'bg-success' : 'bg-secondary' }}">{{ $section->is_new ? 'Yes' : 'No' }}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <h6 class="fw-bold">Daftar Produk</h6>
                    @if(count($produkList))
                      <ul class="mb-0">
                        @foreach($produkList as $p)
                          <li>{{ $p->judul }}</li>
                        @endforeach
                      </ul>
                    @else
                      <div class="alert alert-info mb-0">Belum ada produk terpilih.</div>
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
