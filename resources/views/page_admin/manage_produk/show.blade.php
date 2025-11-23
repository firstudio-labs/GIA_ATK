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
                <li class="breadcrumb-item"><a href="{{ route('manage-produk.index') }}">Manage Produk</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Produk</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Produk</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Produk</h5>
              <div>
                <a href="{{ route('manage-produk.edit', $manageProduk->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('manage-produk.index') }}" class="btn btn-light">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <h6 class="fw-bold">Judul</h6>
                    <p class="mb-0">{{ $manageProduk->judul }}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <h6 class="fw-bold">SKU</h6>
                    <p class="mb-0">{{ $manageProduk->sku }}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <h6 class="fw-bold">Status</h6>
                    <span class="badge {{ $manageProduk->status==='aktif'?'bg-success':'bg-secondary' }}">{{ ucfirst($manageProduk->status) }}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3">
                    <h6 class="fw-bold">Kategori</h6>
                    <p class="mb-0">{{ $manageProduk->kategori->nama_kategori ?? '-' }}</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <h6 class="fw-bold">Sub Kategori</h6>
                    <p class="mb-0">{{ $manageProduk->subKategori->first_nama_sub_kategori ?? '-' }}</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <h6 class="fw-bold">Harga</h6>
                    <p class="mb-0">Rp {{ number_format($manageProduk->harga,0,',','.') }}</p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <h6 class="fw-bold">Deskripsi</h6>
                    <p class="mb-0">{!! nl2br(e($manageProduk->deskripsi)) !!}</p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <h6 class="fw-bold">Galeri Gambar</h6>
                    @php $gals = is_array($manageProduk->gambar_produk) ? $manageProduk->gambar_produk : []; @endphp
                    @if(count($gals))
                      <div class="row g-3">
                        @foreach($gals as $img)
                          <div class="col-md-3">
                            <img src="{{ asset('produk/gambar/'.$img) }}" class="img-fluid rounded" alt="gambar" style="max-height:180px;object-fit:cover;" />
                          </div>
                        @endforeach
                      </div>
                    @else
                      <div class="alert alert-info">Belum ada gambar.</div>
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
