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
                <li class="breadcrumb-item"><a href="{{ route('manage-sub-kategori.index') }}">Sub Kategori</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Sub Kategori</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Sub Kategori</h2>
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
              <h5 class="mb-0">Detail Sub Kategori</h5>
              <div>
                <a href="{{ route('manage-sub-kategori.edit', $manageSubKategori->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('manage-sub-kategori.index') }}" class="btn btn-light">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <h6 class="fw-bold">Kategori</h6>
                    <p class="mb-0">{{ $manageSubKategori->kategori->nama_kategori ?? '-' }}</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-4">
                    <h6 class="fw-bold">Sub Kategori 1</h6>
                    <p class="mb-0">{{ $manageSubKategori->first_nama_sub_kategori }}</p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <h6 class="fw-bold">Sub Kategori 2</h6>
                    <p class="mb-0">{{ $manageSubKategori->second_nama_sub_kategori ?? '-' }}</p>
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
