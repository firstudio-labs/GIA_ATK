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
                <li class="breadcrumb-item" aria-current="page">Form Edit Sub Kategori</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Sub Kategori</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <!-- [ form-element ] start -->
        <div class="col-sm-8">
          <!-- Basic Inputs -->
          <div class="card">
            <div class="card-header">
              <h5>Form Edit Sub Kategori</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-sub-kategori.update', $manageSubKategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Kategori <span class="text-danger">*</span></label>
                      <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                          <option value="{{ $kategori->id }}" {{ old('kategori_id', $manageSubKategori->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                      </select>
                      @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Sub Kategori 1 <span class="text-danger">*</span></label>
                      <input type="text" name="first_nama_sub_kategori" class="form-control @error('first_nama_sub_kategori') is-invalid @enderror" value="{{ old('first_nama_sub_kategori', $manageSubKategori->first_nama_sub_kategori) }}" placeholder="Masukkan sub kategori 1" required>
                      @error('first_nama_sub_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Sub Kategori 2</label>
                      <input type="text" name="second_nama_sub_kategori" class="form-control @error('second_nama_sub_kategori') is-invalid @enderror" value="{{ old('second_nama_sub_kategori', $manageSubKategori->second_nama_sub_kategori) }}" placeholder="Masukkan sub kategori 2">
                      @error('second_nama_sub_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('manage-sub-kategori.index') }}" class="btn btn-light">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
