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
                <li class="breadcrumb-item" aria-current="page">Form Edit Artikel</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Artikel</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5 class="mb-0">Edit Artikel</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label class="form-label">Judul <span class="text-danger">*</span></label>
                  <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $artikel->judul) }}" required>
                  @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Deskripsi Singkat</label>
                  <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan deskripsi singkat">{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                  @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Isi Artikel</label>
                  <textarea name="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" placeholder="Masukkan konten artikel">{{ old('isi', $artikel->isi) }}</textarea>
                  @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Gambar</label>
                  @if($artikel->gambar)
                    <div class="mb-2">
                      <img src="{{ asset('artikel/gambar/' . $artikel->gambar) }}" alt="Gambar" class="img-thumbnail" style="max-height: 120px;">
                    </div>
                  @endif
                  <input type="file" name="gambar" accept="image/*" class="form-control @error('gambar') is-invalid @enderror">
                  <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                  @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="aktif" {{ old('status', $artikel->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $artikel->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                  </select>
                  @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('manage-artikel.index') }}" class="btn btn-light">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
@endsection