@extends('template_web.layout')
@section('content')

    <!-- breadcrumb start -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="radios-breadcrumb breadcrumbs">
                <ul class="list-unstyled d-flex align-items-center">
                    <li class="radiosbcrumb-item radiosbcrumb-begin">
                        <a href="{{ route('landing') }}"><span>Beranda</span></a>
                    </li>
                    <li class="radiosbcrumb-item">
                        <a href="{{ route('riwayat-pesanan.index') }}"><span>Riwayat Pesanan</span></a>
                    </li>
                    <li class="radiosbcrumb-item radiosbcrumb-end">
                        <span>Detail Pesanan</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- start checkout-section -->
    <section class="checkout-section pb-80">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="woocommerce">
                        <h2 class="woocommerce-order-title mb-30">Detail Pesanan - {{ $pesanan->order_id }}</h2>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row mt-none-30">
                            <!-- Detail Produk -->
                            <div class="col-lg-8 mt-30">
                                <div class="woocommerce-order-details">
                                    <h3 class="woocommerce-order-details__title mb-20">Detail Produk</h3>
                                    <div class="woocommerce-table-wrap">
                                        <table class="woocommerce-table shop_table shop_table_responsive">
                                            <thead>
                                                <tr>
                                                    <th class="woocommerce-table__header">No</th>
                                                    <th class="woocommerce-table__header">Produk</th>
                                                    <th class="woocommerce-table__header text-center">Qty</th>
                                                    <th class="woocommerce-table__header text-end">Harga</th>
                                                    <th class="woocommerce-table__header text-end">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $items = is_array($pesanan->produk_items) ? $pesanan->produk_items : json_decode($pesanan->produk_items, true);
                                                @endphp
                                                @foreach($items as $index => $item)
                                                    <tr class="woocommerce-table__row">
                                                        <td class="woocommerce-table__cell" data-title="No">{{ $index + 1 }}</td>
                                                        <td class="woocommerce-table__cell" data-title="Produk">
                                                            <strong>{{ $item['judul'] ?? 'N/A' }}</strong>
                                                        </td>
                                                        <td class="woocommerce-table__cell text-center" data-title="Qty">
                                                            <span class="badge bg-secondary">{{ $item['quantity'] ?? 0 }}</span>
                                                        </td>
                                                        <td class="woocommerce-table__cell text-end" data-title="Harga">
                                                            Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }}
                                                        </td>
                                                        <td class="woocommerce-table__cell text-end" data-title="Subtotal">
                                                            <strong>Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}</strong>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Pesanan -->
                            <div class="col-lg-4 mt-30">
                                <div class="woocommerce-customer-details">
                                    <h3 class="woocommerce-order-details__title mb-20">Informasi Pesanan</h3>
                                    <div class="woocommerce-customer-details-content">
                                        <div class="woocommerce-customer-details-item mb-20">
                                            <strong>Order ID:</strong><br>
                                            <span>{{ $pesanan->order_id }}</span>
                                        </div>
                                        <div class="woocommerce-customer-details-item mb-20">
                                            <strong>Tanggal Pesanan:</strong><br>
                                            <span>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="woocommerce-customer-details-item mb-20">
                                            <strong>Total Item:</strong><br>
                                            <span class="badge bg-primary">{{ $pesanan->quantity }} item</span>
                                        </div>
                                        <div class="woocommerce-customer-details-item mb-20">
                                            <strong>Status Pesanan:</strong><br>
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
                                        </div>
                                        <hr class="mt-20 mb-20">
                                        <div class="woocommerce-order-summary">
                                            <div class="woocommerce-order-summary-item mb-15">
                                                <div class="d-flex justify-content-between">
                                                    <span>Subtotal:</span>
                                                    <strong>Rp {{ number_format($pesanan->sub_total, 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                            <div class="woocommerce-order-summary-item">
                                                <div class="d-flex justify-content-between">
                                                    <span><strong>Total:</strong></span>
                                                    <strong class="text-primary" style="font-size: 1.2em;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="woocommerce-order-actions mt-30">
                                    @if(($pesanan->status ?? 'Pending') === 'Selesai')
                                        <a href="{{ route('riwayat-pesanan.invoice', $pesanan->id) }}" target="_blank" class="thm-btn thm-btn__2 w-100 mb-15">
                                            <span class="btn-wrap">
                                                <span>Cetak Invoice</span>
                                                <span>Cetak Invoice</span>
                                            </span>
                                        </a>
                                    @else
                                        <div class="alert alert-warning mb-15" role="alert">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Invoice hanya dapat diakses setelah pesanan selesai.
                                        </div>
                                    @endif
                                    <a href="{{ route('riwayat-pesanan.index') }}" class="thm-btn thm-btn__2 w-100 mb-15" style="background: #6c757d;">
                                        <span class="btn-wrap">
                                            <span>Kembali ke Riwayat</span>
                                            <span>Kembali ke Riwayat</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('shop') }}" class="thm-btn thm-btn__2 w-100">
                                        <span class="btn-wrap">
                                            <span>Belanja Lagi</span>
                                            <span>Belanja Lagi</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end checkout-section -->

@endsection
