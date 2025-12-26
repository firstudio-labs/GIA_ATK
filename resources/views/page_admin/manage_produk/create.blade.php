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
                <li class="breadcrumb-item"><a href="{{ route('manage-produk.index') }}">Manage Produk</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah Produk</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Produk</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5>Form Tambah Produk</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-produk.store') }}" method="POST" enctype="multipart/form-data" id="produkForm">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Judul <span class="text-danger">*</span></label>
                      <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                      @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">SKU <span class="text-danger">*</span></label>
                      <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}" required>
                      @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status')==='aktif'?'selected':'' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status')==='nonaktif'?'selected':'' }}>Nonaktif</option>
                      </select>
                      @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Kategori <span class="text-danger">*</span></label>
                      <select id="kategoriSelect" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                          <option value="{{ $kategori->id }}" {{ old('kategori_id')==$kategori->id?'selected':'' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                      </select>
                      @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Sub Kategori <span class="text-danger">*</span></label>
                      <select id="subKategoriSelect" name="sub_kategori_id" class="form-control @error('sub_kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Sub Kategori --</option>
                      </select>
                      @error('sub_kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">Harga <span class="text-danger">*</span></label>
                      <input type="number" step="0.01" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                      @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">Diskon (%)</label>
                      <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror" value="{{ old('diskon') }}" min="0" max="100">
                      @error('diskon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Model</label>
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Tambah beberapa model produk</span>
                        <button type="button" class="btn btn-sm btn-success" id="addModelRow"><i class="bx bx-plus"></i> Tambah Model</button>
                      </div>
                      <div id="modelsContainer">
                        @if(old('model') && is_array(old('model')))
                          @foreach(old('model') as $index => $model)
                            @if(!empty($model))
                              <div class="model-row mb-2 p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                  <input type="text" name="model[]" class="form-control me-2" value="{{ $model }}" placeholder="Masukkan model produk" />
                                  <button type="button" class="btn btn-sm btn-danger remove-model-row"><i class="bx bx-trash"></i></button>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        @endif
                      </div>
                      @error('model')
                        <div class="text-danger small">{{ $message }}</div>
                      @elseif($errors->has('model.*'))
                        @foreach($errors->get('model.*') as $errorMessages)
                          @foreach($errorMessages as $errorMessage)
                            <div class="text-danger small">{{ $errorMessage }}</div>
                          @endforeach
                        @endforeach
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Tags</label>
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Tambah beberapa tags produk</span>
                        <button type="button" class="btn btn-sm btn-success" id="addTagRow"><i class="bx bx-plus"></i> Tambah Tag</button>
                      </div>
                      <div id="tagsContainer">
                        @if(old('tags') && is_array(old('tags')))
                          @foreach(old('tags') as $index => $tag)
                            @if(!empty($tag))
                              <div class="tag-row mb-2 p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                  <input type="text" name="tags[]" class="form-control me-2" value="{{ $tag }}" placeholder="Masukkan tag produk" />
                                  <button type="button" class="btn btn-sm btn-danger remove-tag-row"><i class="bx bx-trash"></i></button>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        @endif
                      </div>
                      @error('tags')
                        <div class="text-danger small">{{ $message }}</div>
                      @elseif($errors->has('tags.*'))
                        @foreach($errors->get('tags.*') as $errorMessages)
                          @foreach($errorMessages as $errorMessage)
                            <div class="text-danger small">{{ $errorMessage }}</div>
                          @endforeach
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Berat (kg)</label>
                      <input type="number" step="0.01" name="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}">
                      @error('berat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Ukuran</label>
                      <input type="text" name="ukuran" class="form-control @error('ukuran') is-invalid @enderror" value="{{ old('ukuran') }}">
                      @error('ukuran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Warna</label>
                      <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" value="{{ old('warna') }}">
                      @error('warna')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                      <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi') }}</textarea>
                      @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Detail Produk</label>
                      <textarea name="detail_produk" class="form-control @error('detail_produk') is-invalid @enderror" rows="5">{{ old('detail_produk') }}</textarea>
                      @error('detail_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Gambar Produk <span class="text-danger">*</span></label>
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Tambah beberapa gambar produk (minimal 1, maksimal 10)</span>
                        <button type="button" class="btn btn-sm btn-success" id="addImageRow"><i class="bx bx-plus"></i> Tambah Gambar</button>
                      </div>
                      <div id="imagesContainer">
                        @if(old('gambar_produk') && is_array(old('gambar_produk')))
                          @foreach(old('gambar_produk') as $index => $gambar)
                            @if($gambar && is_string($gambar))
                              <div class="image-row mb-3 p-3 border rounded">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                  <h6 class="mb-0">Gambar #{{ $index + 1 }}</h6>
                                  <button type="button" class="btn btn-sm btn-danger remove-image-row"><i class="bx bx-trash"></i> Hapus</button>
                                </div>
                                <div class="mb-2">
                                  <small class="text-success">File sudah dipilih: {{ basename($gambar) }}</small>
                                </div>
                                <input type="file" name="gambar_produk[]" accept="image/*" class="form-control" />
                              </div>
                            @endif
                          @endforeach
                        @endif
                      </div>
                      @error('gambar_produk')
                        <div class="text-danger small">{{ $message }}</div>
                      @elseif($errors->has('gambar_produk.*'))
                        @foreach($errors->get('gambar_produk.*') as $errorMessages)
                          @foreach($errorMessages as $errorMessage)
                            <div class="text-danger small">{{ $errorMessage }}</div>
                          @endforeach
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('manage-produk.index') }}" class="btn btn-light">Batal</a>
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
<script>
  // Client-side validation
  document.getElementById('produkForm').addEventListener('submit', function(e) {
    let isValid = true;
    const errors = [];

    // Validate required fields
    const requiredFields = ['judul', 'sku', 'harga', 'deskripsi'];
    requiredFields.forEach(field => {
      const element = document.getElementById(field);
      if (element && !element.value.trim()) {
        isValid = false;
        errors.push(`${field.charAt(0).toUpperCase() + field.slice(1)} wajib diisi`);
      }
    });

    // Validate select fields
    const selectFields = ['kategoriSelect', 'subKategoriSelect'];
    selectFields.forEach(field => {
      const element = document.getElementById(field);
      if (element && !element.value) {
        isValid = false;
        const label = field === 'kategoriSelect' ? 'Kategori' : 'Sub Kategori';
        errors.push(`${label} wajib dipilih`);
      }
    });

    // Validate harga
    const harga = document.getElementById('harga');
    if (harga && harga.value) {
      const hargaValue = parseFloat(harga.value);
      if (hargaValue < 0) {
        isValid = false;
        errors.push('Harga tidak boleh negatif');
      } else if (hargaValue > 999999999) {
        isValid = false;
        errors.push('Harga terlalu besar');
      }
    }

    // Validate diskon
    const diskon = document.querySelector('input[name="diskon"]');
    if (diskon && diskon.value) {
      const diskonValue = parseInt(diskon.value);
      if (diskonValue < 0 || diskonValue > 100) {
        isValid = false;
        errors.push('Diskon harus antara 0-100%');
      }
    }

    // Validate minimal 1 gambar
    const imageInputs = document.querySelectorAll('input[name="gambar_produk[]"]');
    let hasImage = false;
    imageInputs.forEach(input => {
      if (input.files && input.files.length > 0) {
        hasImage = true;
      }
    });

    if (!hasImage && imageInputs.length === 0) {
      isValid = false;
      errors.push('Minimal 1 gambar produk wajib diupload');
    }

    // Show errors
    if (!isValid) {
      e.preventDefault();
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Validasi Error',
          html: errors.join('<br>'),
          icon: 'error',
          confirmButtonText: 'OK'
        });
      } else {
        alert('Error Validasi:\n' + errors.join('\n'));
      }
      return false;
    }
  });
</script>
<script>
  function fetchSubKategori(kategoriId, preselected = '') {
    const subSelect = document.getElementById('subKategoriSelect');
    subSelect.innerHTML = '<option value="">Memuat...</option>';
    const url = `{{ route('ajax.sub-kategori.by-kategori') }}?kategori_id=${kategoriId}`;
    fetch(url)
      .then(r => r.json())
      .then(items => {
        subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
        items.forEach(it => {
          const opt = document.createElement('option');
          opt.value = it.id; opt.textContent = it.first_nama_sub_kategori;
          if (preselected && String(preselected) === String(it.id)) opt.selected = true;
          subSelect.appendChild(opt);
        });
      })
      .catch(() => { subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>'; });
  }

  document.getElementById('kategoriSelect').addEventListener('change', function(){
    if (this.value) fetchSubKategori(this.value);
  });

  // Dynamic images inputs
  let imgIdx = 0;
  document.getElementById('addImageRow').addEventListener('click', function(){
    const wrap = document.getElementById('imagesContainer');
    const row = document.createElement('div');
    row.className = 'image-row mb-3 p-3 border rounded';
    row.innerHTML = `
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="mb-0">Gambar #${imgIdx + 1}</h6>
        <button type="button" class="btn btn-sm btn-danger remove-image-row"><i class="bx bx-trash"></i> Hapus</button>
      </div>
      <input type="file" name="gambar_produk[]" accept="image/*" class="form-control" />
    `;
    wrap.appendChild(row); imgIdx++;
  });

  document.addEventListener('click', function(e){
    if (e.target.closest('.remove-image-row')) {
      e.target.closest('.image-row').remove();
    }
  });

  // Dynamic model inputs
  let modelIdx = 0;
  document.getElementById('addModelRow').addEventListener('click', function(){
    const wrap = document.getElementById('modelsContainer');
    const row = document.createElement('div');
    row.className = 'model-row mb-2 p-2 border rounded';
    row.innerHTML = `
      <div class="d-flex justify-content-between align-items-center">
        <input type="text" name="model[]" class="form-control me-2" placeholder="Masukkan model produk" />
        <button type="button" class="btn btn-sm btn-danger remove-model-row"><i class="bx bx-trash"></i></button>
      </div>
    `;
    wrap.appendChild(row); modelIdx++;
  });

  document.addEventListener('click', function(e){
    if (e.target.closest('.remove-model-row')) {
      e.target.closest('.model-row').remove();
    }
  });

  // Dynamic tags inputs
  let tagIdx = 0;
  document.getElementById('addTagRow').addEventListener('click', function(){
    const wrap = document.getElementById('tagsContainer');
    const row = document.createElement('div');
    row.className = 'tag-row mb-2 p-2 border rounded';
    row.innerHTML = `
      <div class="d-flex justify-content-between align-items-center">
        <input type="text" name="tags[]" class="form-control me-2" placeholder="Masukkan tag produk" />
        <button type="button" class="btn btn-sm btn-danger remove-tag-row"><i class="bx bx-trash"></i></button>
      </div>
    `;
    wrap.appendChild(row); tagIdx++;
  });

  document.addEventListener('click', function(e){
    if (e.target.closest('.remove-tag-row')) {
      e.target.closest('.tag-row').remove();
    }
  });
</script>
@endsection

