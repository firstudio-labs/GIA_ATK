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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Riwayat Pesanan</a></li>
                <li class="breadcrumb-item" aria-current="page">Daftar Riwayat Pesanan</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Daftar Riwayat Pesanan</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Riwayat Pesanan</h5>
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

              <!-- Form Pencarian -->
              <div class="row mb-3">
                <div class="col-md-4">
                  <form method="GET" action="{{ route('daftar-riwayat-pesanan.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari Order ID..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-search"></i> Cari
                    </button>
                    @if(request('search'))
                      <a href="{{ route('daftar-riwayat-pesanan.index') }}" class="btn btn-secondary ms-2">
                        <i class="bx bx-x"></i> Reset
                      </a>
                    @endif
                  </form>
                </div>
              </div>

              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Customer</th>
                      <th>Email</th>
                      <th>Tanggal Pesanan</th>
                      <th>Status</th>
                      <th>Jumlah Item</th>
                      <th>Subtotal</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($pesanans as $e => $pesanan)
                    <tr>
                      <td>{{ ($pesanans->currentPage() - 1) * $pesanans->perPage() + $e + 1 }}</td>
                      <td><strong>{{ $pesanan->order_id }}</strong></td>
                      <td>{{ $pesanan->user->name ?? 'N/A' }}</td>
                      <td>{{ $pesanan->user->email ?? 'N/A' }}</td>
                      <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</td>
                      <td>
                        @php
                          $statusColors = [
                            'Pending' => 'bg-warning',
                            'Diterima' => 'bg-info',
                            'Diproses' => 'bg-primary',
                            'Selesai' => 'bg-success'
                          ];
                          $color = $statusColors[$pesanan->status ?? 'Pending'] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $color }}">{{ $pesanan->status ?? 'Pending' }}</span>
                      </td>
                      <td><span class="badge bg-primary">{{ $pesanan->quantity }} item</span></td>
                      <td>Rp {{ number_format($pesanan->sub_total, 0, ',', '.') }}</td>
                      <td><strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong></td>
                      <td>
                        <a href="{{ route('daftar-riwayat-pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info">
                          <i class="bx bx-show"></i> Detail
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="10" class="text-center">Tidak ada data pesanan</td>
                    </tr>
                    @endforelse
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Customer</th>
                      <th>Email</th>
                      <th>Tanggal Pesanan</th>
                      <th>Status</th>
                      <th>Jumlah Item</th>
                      <th>Subtotal</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <!-- Pagination -->
              @if($pesanans->hasPages())
              <div class="mt-3">
                {{ $pesanans->links() }}
              </div>
              @endif
            </div>
          </div>
        </div>
        <!-- Zero config table end -->
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $('#simpletable').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "ordering": true,
        "order": [[4, "desc"]]
      });
    });
  </script>
@endsection
