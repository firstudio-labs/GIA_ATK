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
                <li class="breadcrumb-item"><a href="{{ route('daftar-customer.index') }}">Daftar Customer</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Customer</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Customer</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Customer - {{ $customer->name }}</h5>
              <div>
                <a href="{{ route('daftar-customer.index') }}" class="btn btn-light">
                  <i class="bx bx-arrow-back"></i> Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Informasi Customer -->
                <div class="col-md-6 mb-4">
                  <div class="card border">
                    <div class="card-header bg-primary text-white">
                      <h6 class="mb-0"><i class="bx bx-user me-2"></i>Informasi Customer</h6>
                    </div>
                    <div class="card-body">
                      <div class="text-center mb-3">
                        @if($customer->foto_profile)
                          <img src="{{ asset('upload/foto_profile/' . $customer->foto_profile) }}" alt="Foto" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                          <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                            <i class="bx bx-user" style="font-size: 60px;"></i>
                          </div>
                        @endif
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Nama</label>
                        <strong>{{ $customer->name }}</strong>
                      </div>
                      @if($customer->username)
                      <div class="mb-3">
                        <label class="text-muted small d-block">Username</label>
                        <strong>{{ $customer->username }}</strong>
                      </div>
                      @endif
                      <div class="mb-3">
                        <label class="text-muted small d-block">Email</label>
                        <strong>{{ $customer->email }}</strong>
                      </div>
                      @if($customer->no_wa)
                      <div class="mb-3">
                        <label class="text-muted small d-block">No. WhatsApp</label>
                        <strong>
                          <a href="https://wa.me/{{ $customer->no_wa }}" target="_blank" class="text-success">
                            {{ $customer->no_wa }}
                            <i class="bx bx-link-external"></i>
                          </a>
                        </strong>
                      </div>
                      @endif
                      <div class="mb-3">
                        <label class="text-muted small d-block">Tanggal Daftar</label>
                        <strong>{{ \Carbon\Carbon::parse($customer->created_at)->format('d M Y, H:i') }}</strong>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Statistik Pesanan -->
                <div class="col-md-6 mb-4">
                  <div class="card border">
                    <div class="card-header bg-info text-white">
                      <h6 class="mb-0"><i class="bx bx-chart me-2"></i>Statistik Pesanan</h6>
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="text-muted small d-block">Total Pesanan</label>
                        <strong class="text-primary" style="font-size: 1.5em;">{{ $totalPesanan }}</strong>
                        <span class="text-muted">pesanan</span>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Total Belanja</label>
                        <strong class="text-success" style="font-size: 1.5em;">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Rata-rata per Pesanan</label>
                        <strong>
                          @if($totalPesanan > 0)
                            Rp {{ number_format($totalBelanja / $totalPesanan, 0, ',', '.') }}
                          @else
                            Rp 0
                          @endif
                        </strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Riwayat Pesanan Terbaru -->
              <div class="row">
                <div class="col-12">
                  <div class="card border">
                    <div class="card-header bg-success text-white">
                      <h6 class="mb-0"><i class="bx bx-shopping-bag me-2"></i>Riwayat Pesanan Terbaru</h6>
                    </div>
                    <div class="card-body">
                      @if($pesananTerbaru->count() > 0)
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Tanggal</th>
                                <th class="text-center">Jumlah Item</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($pesananTerbaru as $index => $pesanan)
                                <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td><strong>{{ $pesanan->order_id }}</strong></td>
                                  <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</td>
                                  <td class="text-center">
                                    <span class="badge bg-secondary">{{ $pesanan->quantity }} item</span>
                                  </td>
                                  <td class="text-end">Rp {{ number_format($pesanan->sub_total, 0, ',', '.') }}</td>
                                  <td class="text-end">
                                    <strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
                                  </td>
                                  <td class="text-center">
                                    <a href="{{ route('daftar-riwayat-pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info">
                                      <i class="bx bx-show"></i> Detail
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      @else
                        <div class="alert alert-info mb-0">
                          <i class="bx bx-info-circle"></i> Customer ini belum melakukan pesanan.
                        </div>
                      @endif
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
