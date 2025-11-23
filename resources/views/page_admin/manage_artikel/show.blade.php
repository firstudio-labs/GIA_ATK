@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manage-artikel.index') }}">Manage Artikel</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail Artikel</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Detail Artikel</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $artikel->judul }}</h5>
                        <div class="btn-group">
                            <a href="{{ route('manage-artikel.edit', $artikel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('manage-artikel.index') }}" class="btn btn-light btn-sm">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="badge {{ $artikel->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">Status: {{ ucfirst($artikel->status) }}</span>
                            <span class="badge bg-info text-dark ms-2">Slug: {{ $artikel->slug }}</span>
                        </div>

                        @if($artikel->gambar)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('artikel/gambar/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid rounded" style="max-height:300px;object-fit:cover;">
                        </div>
                        @endif

                        <div class="mb-4">
                            <h6 class="fw-bold">Deskripsi</h6>
                            <p class="mb-0">{!! nl2br(e($artikel->deskripsi)) !!}</p>
                        </div>

                        <div>
                            <h6 class="fw-bold">Isi Artikel</h6>
                            <div class="border rounded p-3">{!! $artikel->isi !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection