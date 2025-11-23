@extends('template_admin.layout')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Home</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ asset('admin') }}/dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Layanan</h6>
                            <h4 class="mb-3">{{ number_format($totalLayanan, 0, ',', '.') }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                <a href="{{ route('manage-layanan.index') }}" class="text-primary">Lihat Semua Layanan</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Produk</h6>
                            <h4 class="mb-3">{{ number_format($totalProduk, 0, ',', '.') }} 
                                <span class="badge bg-light-success border border-success">{{ $totalProdukAktif }} Aktif</span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">
                                <a href="{{ route('manage-produk.index') }}" class="text-primary">Lihat Semua Produk</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Pesanan</h6>
                            <h4 class="mb-3">{{ number_format($totalPesanan, 0, ',', '.') }} 
                                <span class="badge bg-light-primary border border-primary">{{ $pesananBulanIni }} Bulan Ini</span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">
                                <a href="{{ route('daftar-riwayat-pesanan.index') }}" class="text-primary">Lihat Semua Pesanan</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Pendapatan</h6>
                            <h4 class="mb-3">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                Bulan ini: <span class="text-success">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Statistik Tambahan -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                            <h4 class="mb-3">{{ number_format($totalUsers, 0, ',', '.') }}</h4>
                            <p class="mb-0 text-muted text-sm">Total pengguna terdaftar</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Section</h6>
                            <h4 class="mb-3">{{ number_format($totalSection, 0, ',', '.') }}</h4>
                            <p class="mb-0 text-muted text-sm">
                                <a href="{{ route('manage-section.index') }}" class="text-primary">Lihat Semua Section</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Produk Aktif</h6>
                            <h4 class="mb-3">{{ number_format($totalProdukAktif, 0, ',', '.') }}</h4>
                            <p class="mb-0 text-muted text-sm">Produk yang tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Pesanan 7 Hari</h6>
                            <h4 class="mb-3">{{ number_format($pesanan7HariTerakhir, 0, ',', '.') }}</h4>
                            <p class="mb-0 text-muted text-sm">Pesanan minggu ini</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-8">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Statistik Pesanan (6 Bulan Terakhir)</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="pesanan-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Statistik Produk</h5>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Status Produk</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h3 class="mb-0">{{ $totalProdukAktif }}</h3>
                                    <p class="mb-0 text-muted small">Produk Aktif</p>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ $totalProdukNonaktif }}</h3>
                                    <p class="mb-0 text-muted small">Produk Nonaktif</p>
                                </div>
                            </div>
                            <div id="produk-chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-8">
                    <h5 class="mb-3">Pesanan Terbaru</h5>
                    <div class="card tbl-card">
                        <div class="card-body">
                            @if($pesananTerbaru->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>ORDER ID</th>
                                            <th>CUSTOMER</th>
                                            <th>TANGGAL</th>
                                            <th>QUANTITY</th>
                                            <th class="text-end">TOTAL</th>
                                            <th class="text-end">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesananTerbaru as $pesanan)
                                        <tr>
                                            <td><a href="{{ route('daftar-riwayat-pesanan.show', $pesanan->id) }}" class="text-primary">{{ $pesanan->order_id }}</a></td>
                                            <td>{{ $pesanan->user->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y') }}</td>
                                            <td><span class="badge bg-primary">{{ $pesanan->quantity }} item</span></td>
                                            <td class="text-end">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('daftar-riwayat-pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <p class="text-muted">Belum ada pesanan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Ringkasan Statistik</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('manage-layanan.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                Total Layanan
                                <span class="h5 mb-0">{{ number_format($totalLayanan, 0, ',', '.') }}</span>
                            </a>
                            <a href="{{ route('manage-section.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                Total Section
                                <span class="h5 mb-0">{{ number_format($totalSection, 0, ',', '.') }}</span>
                            </a>
                            <a href="{{ route('manage-produk.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                Total Produk
                                <span class="h5 mb-0">{{ number_format($totalProduk, 0, ',', '.') }}</span>
                            </a>
                        </div>
                        <div class="card-body px-2">
                            <h6 class="mb-2">Pendapatan Bulan Ini</h6>
                            <h3 class="mb-0 text-success">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-8">
                    <h5 class="mb-3">Grafik Pendapatan (6 Bulan Terakhir)</h5>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                            <div id="pendapatan-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Chart Pesanan
            var pesananOptions = {
                series: [{
                    name: 'Jumlah Pesanan',
                    data: @json($chartPesanan)
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: @json($chartLabels)
                },
                colors: ['#5D87FF'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                }
            };
            var pesananChart = new ApexCharts(document.querySelector("#pesanan-chart"), pesananOptions);
            pesananChart.render();

            // Chart Produk (Donut Chart)
            var produkOptions = {
                series: [{{ $totalProdukAktif }}, {{ $totalProdukNonaktif }}],
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: ['Produk Aktif', 'Produk Nonaktif'],
                colors: ['#00C853', '#FF5252'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed(1) + "%"
                    }
                }
            };
            var produkChart = new ApexCharts(document.querySelector("#produk-chart"), produkOptions);
            produkChart.render();

            // Chart Pendapatan
            var pendapatanOptions = {
                series: [{
                    name: 'Pendapatan (Rp)',
                    data: @json($chartPendapatan)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: @json($chartLabels)
                },
                yaxis: {
                    labels: {
                        formatter: function (val) {
                            return 'Rp ' + (val / 1000).toFixed(0) + 'K';
                        }
                    }
                },
                colors: ['#00C853'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.3,
                        gradientToColors: ['#00E676'],
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                }
            };
            var pendapatanChart = new ApexCharts(document.querySelector("#pendapatan-chart"), pendapatanOptions);
            pendapatanChart.render();
        }, 500);
    });
</script>
@endsection
