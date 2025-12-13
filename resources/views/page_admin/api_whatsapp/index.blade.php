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
                <li class="breadcrumb-item"><a href="javascript: void(0)">API Whatsapp</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah API Whatsapp</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form API Whatsapp</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Informasi API -->
        <div class="col-md-12 mb-4">
          <div class="card border-primary">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="ti ti-info-circle me-2"></i>Informasi API Fonnte</h5>
            </div>
            <div class="card-body">
              <div class="row align-items-center mb-3">
                <div class="col-md-2 text-center">
                  <img src="https://md.fonnte.com/new/assets/img/logo.png" alt="Fonnte Logo" style="max-width: 100px;">
                </div>
                <div class="col-md-10">
                  <h6 class="mb-2">Fonnte WhatsApp API</h6>
                  <p class="mb-2 text-muted">
                    Aplikasi ini menggunakan <strong>Fonnte API</strong> untuk mengirim pesan WhatsApp otomatis. 
                    Fonnte adalah layanan API WhatsApp yang memungkinkan pengiriman pesan melalui WhatsApp Business API.
                  </p>
                  <p class="mb-0">
                    <strong>Website:</strong> <a href="https://md.fonnte.com/" target="_blank" class="text-primary">https://md.fonnte.com/</a>
                  </p>
                </div>
              </div>
              
              <div class="alert alert-info mb-0">
                <h6 class="alert-heading"><i class="ti ti-bulb me-2"></i>Cara Mendapatkan Access Token:</h6>
                <ol class="mb-0 ps-3">
                  <li>Daftar atau login ke akun Fonnte di <a href="https://md.fonnte.com/" target="_blank">https://md.fonnte.com/</a></li>
                  <li>Masuk ke dashboard akun Anda</li>
                  <li>Buka menu <strong>API</strong> atau <strong>Settings</strong></li>
                  <li>Salin <strong>Access Token</strong> yang diberikan</li>
                  <li>Paste token tersebut ke form di bawah ini</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Input -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5>Form API Whatsapp</h5>
            </div>
            <div class="card-body">
              @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <form action="{{ route('whatsapp-api.storeorupdate') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                  <label class="form-label">Access Token <span class="text-danger">*</span></label>
                  <input type="text" name="access_token" class="form-control @error('access_token') is-invalid @enderror" 
                         placeholder="Masukkan Access Token dari Fonnte" 
                         value="{{ $whatsappApi ? $whatsappApi->access_token : old('access_token') }}" 
                         required>
                  <div class="form-text">
                    Token ini digunakan untuk autentikasi saat mengirim pesan WhatsApp melalui Fonnte API
                  </div>
                  @error('access_token')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="card-footer bg-transparent px-0">
                  <button type="submit" class="btn btn-primary me-2">
                    <i class="ti ti-device-floppy me-1"></i> Simpan
                  </button>
                  <button type="reset" class="btn btn-light">
                    <i class="ti ti-refresh me-1"></i> Reset
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Dokumentasi Penggunaan -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5>Dokumentasi Penggunaan</h5>
            </div>
            <div class="card-body">
              <h6 class="mb-3">Fitur yang Menggunakan API Ini:</h6>
              <ul class="list-unstyled">
                <li class="mb-2">
                  <i class="ti ti-check text-success me-2"></i>
                  <strong>Reset Password via OTP</strong>
                  <p class="text-muted small mb-0 ms-4">Mengirim kode OTP ke WhatsApp user saat reset password</p>
                </li>
              </ul>

              <hr>

              <h6 class="mb-3">Endpoint API yang Digunakan:</h6>
              <div class="bg-light p-3 rounded mb-3">
                <code class="text-primary">POST https://api.fonnte.com/send</code>
              </div>

              <h6 class="mb-2">Parameter:</h6>
              <ul class="list-unstyled small">
                <li><strong>target:</strong> Nomor WhatsApp tujuan (format: 6281234567890)</li>
                <li><strong>message:</strong> Isi pesan yang akan dikirim</li>
                <li><strong>Authorization:</strong> Access Token (di header)</li>
              </ul>

              <div class="alert alert-warning mb-0">
                <i class="ti ti-alert-triangle me-2"></i>
                <strong>Catatan:</strong> Pastikan nomor WhatsApp yang digunakan sudah terhubung dengan akun Fonnte Anda.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection