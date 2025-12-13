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
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manage-kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Kategori</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Kategori</h2>
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
              <h5 class="mb-0">Detail Kategori</h5>
              <div>
                <a href="{{ route('manage-kategori.edit', $manageKategori->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('manage-kategori.index') }}" class="btn btn-light">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Nama Kategori</h6>
                    <p class="mb-0">{{ $manageKategori->nama_kategori }}</p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Deskripsi</h6>
                    <p class="mb-0">{!! nl2br(e($manageKategori->deskripsi)) !!}</p>
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
