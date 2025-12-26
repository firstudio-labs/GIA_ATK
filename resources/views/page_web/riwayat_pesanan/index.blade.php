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
                    <li class="radiosbcrumb-item radiosbcrumb-end">
                        <span>Riwayat Pesanan</span>
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
                        <h2 class="woocommerce-order-title mb-30">Riwayat Pesanan Saya</h2>

                        @if($pesanans->count() > 0)
                            <div class="woocommerce-order-table-wrap">
                                <table class="woocommerce-orders-table shop_table shop_table_responsive">
                                    <thead>
                                        <tr>
                                            <th class="woocommerce-orders-table__header">Order ID</th>
                                            <th class="woocommerce-orders-table__header">Tanggal Pesanan</th>
                                            <th class="woocommerce-orders-table__header">Status</th>
                                            <th class="woocommerce-orders-table__header">Jumlah Item</th>
                                            <th class="woocommerce-orders-table__header">Total</th>
                                            <th class="woocommerce-orders-table__header">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesanans as $pesanan)
                                            <tr class="woocommerce-orders-table__row">
                                                <td class="woocommerce-orders-table__cell" data-title="Order ID">
                                                    <strong>{{ $pesanan->order_id }}</strong>
                                                </td>
                                                <td class="woocommerce-orders-table__cell" data-title="Tanggal">
                                                    {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}
                                                </td>
                                                <td class="woocommerce-orders-table__cell" data-title="Status">
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
                                                <td class="woocommerce-orders-table__cell" data-title="Item">
                                                    <span class="badge bg-primary">{{ $pesanan->quantity }} item</span>
                                                </td>
                                                <td class="woocommerce-orders-table__cell" data-title="Total">
                                                    <strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
                                                </td>
                                                <td class="woocommerce-orders-table__cell" data-title="Aksi">
                                                    <a href="{{ route('riwayat-pesanan.detail', $pesanan->id) }}" class="thm-btn thm-btn__2">
                                                        <span class="btn-wrap">
                                                            <span>Detail</span>
                                                            <span>Detail</span>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="woocommerce-info text-center py-5">
                                <div class="mb-4">
                                    <i class="far fa-shopping-bag" style="font-size: 64px; color: #ccc;"></i>
                                </div>
                                <h4>Belum Ada Pesanan</h4>
                                <p class="text-muted mb-4">Anda belum memiliki riwayat pesanan.</p>
                                <a href="{{ route('shop') }}" class="thm-btn thm-btn__2">
                                    <span class="btn-wrap">
                                        <span>Mulai Belanja</span>
                                        <span>Mulai Belanja</span>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end checkout-section -->

@endsection
