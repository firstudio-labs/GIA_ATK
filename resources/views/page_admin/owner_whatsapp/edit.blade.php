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
                <li class="breadcrumb-item"><a href="{{ route('owner-whatsapp.index') }}">Owner WhatsApp</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Data Owner WhatsApp</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Data Owner WhatsApp</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <!-- [ form-element ] start -->
        <div class="col-sm-10">
          <!-- Basic Inputs -->
          <div class="card">
            <div class="card-header">
              <h5>Form Edit Data Owner WhatsApp</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('owner-whatsapp.update', $ownerWhatsapp->id) }}" method="POST" id="ownerWhatsappForm">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                      @php
                        $noWa = old('no_wa', $ownerWhatsapp->no_wa);
                        // Remove 628 prefix if exists for display
                        $noWaDisplay = $noWa;
                        if (strpos($noWa, '628') === 0) {
                            $noWaDisplay = substr($noWa, 3);
                        }
                      @endphp
                      <div class="input-group">
                        <span class="input-group-text">628</span>
                        <input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ $noWaDisplay }}" placeholder="Masukkan nomor WhatsApp (contoh: 6281234567890)" required>
                      </div>
                      <small class="form-text text-muted">Nomor WhatsApp harus dimulai dengan 628 (format: 628xxxxxxxxxx)</small>
                      @error('no_wa')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Template Pesan <span class="text-danger">*</span></label>
                      <textarea name="template_pesan" class="form-control @error('template_pesan') is-invalid @enderror" rows="8" placeholder="Masukkan template pesan WhatsApp" required>{{ old('template_pesan', $ownerWhatsapp->template_pesan) }}</textarea>
                      @error('template_pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('owner-whatsapp.index') }}" class="btn btn-light">Batal</a>
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
    document.getElementById('ownerWhatsappForm').addEventListener('submit', function(e) {
        const noWaInput = document.querySelector('input[name="no_wa"]');
        let noWa = noWaInput.value.trim();
        
        // Remove any non-digit characters
        noWa = noWa.replace(/\D/g, '');
        
        // If doesn't start with 628, prepend it
        if (!noWa.startsWith('628')) {
            if (noWa.startsWith('0')) {
                noWa = '62' + noWa.substring(1);
            } else if (!noWa.startsWith('62')) {
                noWa = '628' + noWa;
            } else {
                noWa = '628' + noWa.substring(2);
            }
        }
        
        noWaInput.value = noWa;
    });
</script>
@endsection
