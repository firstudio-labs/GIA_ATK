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
                <li class="breadcrumb-item" aria-current="page">Detail Data Owner WhatsApp</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Owner WhatsApp</h2>
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
              <h5 class="mb-0">Detail Data Owner WhatsApp</h5>
              <div>
                <a href="{{ route('owner-whatsapp.edit', $ownerWhatsapp->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('owner-whatsapp.index') }}" class="btn btn-light">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Nomor WhatsApp</h6>
                    <p class="mb-0">
                      <a href="https://wa.me/{{ $ownerWhatsapp->no_wa }}" target="_blank" class="text-primary">
                        {{ $ownerWhatsapp->no_wa }}
                        <i class="bx bx-link-external"></i>
                      </a>
                    </p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-4">
                    <h6 class="fw-bold">Template Pesan</h6>
                    <div class="border rounded p-3 bg-light">
                      <p class="mb-0" style="white-space: pre-wrap;">{{ $ownerWhatsapp->template_pesan }}</p>
                    </div>
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
