@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <style>
        :root{--pri:#4F46E5;--pri-600:#4338CA;--sec:#0EA5E9;--acc:#22C55E;--warn:#F59E0B;--danger:#EF4444;--muted:#6b7280}
        .card{border:0;border-radius:12px}
        .card-header{border-bottom:0;border-top-left-radius:12px;border-top-right-radius:12px;background:linear-gradient(135deg,var(--pri),var(--sec));color:#fff}
        .btn-primary{background:var(--pri);border-color:var(--pri)}
        .btn-primary:hover{background:var(--pri-600);border-color:var(--pri-600)}
        .btn-info{background:var(--sec);border-color:var(--sec)}
        .page-header-title h2{font-weight:700}
        .breadcrumb .breadcrumb-item a{color:var(--pri)}
        table.dataTable thead th{background:#f8fafc;color:#111827}
      </style>
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Daftar Customer</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Data Customer</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Customer</h5>
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
                  <form method="GET" action="{{ route('daftar-customer.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari nama, email, username, atau no WA..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-search"></i> Cari
                    </button>
                    @if(request('search'))
                      <a href="{{ route('daftar-customer.index') }}" class="btn btn-secondary ms-2">
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
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>No. WhatsApp</th>
                      <th>Total Pesanan</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($customers as $e => $customer)
                    <tr>
                      <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $e + 1 }}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          @if($customer->foto_profile)
                            <img src="{{ asset('upload/foto_profile/' . $customer->foto_profile) }}" alt="Foto" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                          @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                              <i class="bx bx-user"></i>
                            </div>
                          @endif
                          <strong>{{ $customer->name }}</strong>
                        </div>
                      </td>
                      <td>{{ $customer->username ?? '-' }}</td>
                      <td>{{ $customer->email }}</td>
                      <td>
                        @if($customer->no_wa)
                          <a href="https://wa.me/{{ $customer->no_wa }}" target="_blank" class="text-success">
                            {{ $customer->no_wa }}
                            <i class="bx bx-link-external"></i>
                          </a>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
                      <td><span class="badge bg-primary">{{ $customer->pesanans_count ?? 0 }} pesanan</span></td>
                      <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('d M Y') }}</td>
                      <td>
                        <a href="{{ route('daftar-customer.show', $customer->id) }}" class="btn btn-sm btn-info">
                          <i class="bx bx-show"></i> Detail
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="8" class="text-center">Tidak ada data customer</td>
                    </tr>
                    @endforelse
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>No. WhatsApp</th>
                      <th>Total Pesanan</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <!-- Pagination -->
              @if($customers->hasPages())
              <div class="mt-3">
                {{ $customers->links() }}
              </div>
              @endif
            </div>
          </div>
        </div>
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
        "order": [[6, "desc"]]
      });
    });
  </script>
@endsection
