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
                        <a href="{{ route('shop') }}"><span>Produk</span></a>
                    </li>
                    <li class="radiosbcrumb-item radiosbcrumb-end">
                        <span>Checkout</span>
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
                <div class="col-lg-8">
                    <div class="woocommerce">
                        @if(isset($pesanan))
                            <div class="woocommerce-info" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                                <h4 style="color: #155724; margin-bottom: 15px;"><i class="fas fa-check-circle"></i> Pesanan Berhasil Dibuat!</h4>
                                <p class="mb-2"><strong>ID Pesanan:</strong> #{{ $pesanan->order_id ?? $pesanan->id }}</p>
                                <p class="mb-2"><strong>Nama Penerima:</strong> {{ $request->nama_penerima }}</p>
                                <p class="mb-2"><strong>No. WhatsApp:</strong> {{ $request->no_wa_penerima }}</p>
                                <p class="mb-0"><strong>Alamat:</strong> {{ $request->alamat_penerima }}</p>
                            </div>
                            <div class="woocommerce-info" style="background-color: #d1ecf1; border-color: #bee5eb; color: #0c5460; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                                <p class="mb-0">Klik tombol di bawah untuk melanjutkan ke WhatsApp dan mengirim detail pesanan.</p>
                            </div>
                        @else
                            <h3 class="mb-4">Detail Penerima</h3>
                            <form action="{{ route('pesanan.process') }}" method="POST" id="checkoutForm" class="checkout woocommerce-checkout">
                                @csrf
                                <div class="woocommerce-billing-fields">
                                    <p class="form-row form-row-wide validate-required" id="nama_penerima_field">
                                        <label for="nama_penerima" class="">Nama Penerima <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="input-text @error('nama_penerima') is-invalid @enderror" 
                                            id="nama_penerima" name="nama_penerima" 
                                            value="{{ old('nama_penerima', $user->name ?? '') }}" required>
                                        @error('nama_penerima')
                                            <span class="error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p class="form-row form-row-wide validate-required validate-phone" id="no_wa_penerima_field">
                                        <label for="no_wa_penerima" class="">No. WhatsApp Penerima <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="input-text @error('no_wa_penerima') is-invalid @enderror" 
                                            id="no_wa_penerima" name="no_wa_penerima" 
                                            value="{{ old('no_wa_penerima', $user->no_wa ?? '') }}" 
                                            placeholder="08xxxxxxxxxx" required>
                                        @error('no_wa_penerima')
                                            <span class="error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p class="form-row form-row-wide address-field validate-required" id="alamat_penerima_field">
                                        <label for="alamat_penerima" class="">Alamat Lengkap <abbr class="required" title="required">*</abbr></label>
                                        <textarea class="input-text @error('alamat_penerima') is-invalid @enderror" 
                                            id="alamat_penerima" name="alamat_penerima" rows="4" required>{{ old('alamat_penerima') }}</textarea>
                                        @error('alamat_penerima')
                                            <span class="error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </p>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="woocommerce-order-review">
                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <h3 id="order_review_heading" class="mb-4">Ringkasan Pesanan</h3>
                            
                            <table class="shop_table woocommerce-checkout-review-order-table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Produk</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                {{ $item['judul'] }}&nbsp;
                                                <strong class="product-quantity">× {{ $item['quantity'] }}</strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">Rp</span>{{ number_format($item['total'], 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">Rp</span>{{ number_format($subtotal, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">Rp</span>{{ number_format($subtotal, 0, ',', '.') }}
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="woocommerce-checkout-payment" style="margin-top: 30px;">
                                @if(isset($pesanan) && isset($whatsappLink))
                                    <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="thm-btn thm-btn__2 w-100" style="background-color:#25D366; border: none; color:#fff; text-align: center;">
                                        <span class="btn-wrap">
                                            <span><i class="fab fa-whatsapp"></i> Lanjutkan Pemesanan via WhatsApp</span>
                                            <span><i class="fab fa-whatsapp"></i> Lanjutkan Pemesanan via WhatsApp</span>
                                        </span>
                                    </a>
                                @else
                                    <button type="submit" form="checkoutForm" class="thm-btn thm-btn__2 w-100" style="background-color:#25D366; border: none; color:#fff;">
                                        <span class="btn-wrap">
                                            <span><i class="fab fa-whatsapp"></i> Lanjutkan Pemesanan via WhatsApp</span>
                                            <span><i class="fab fa-whatsapp"></i> Lanjutkan Pemesanan via WhatsApp</span>
                                        </span>
                                    </button>
                                @endif
                                <a href="{{ route('shop') }}" class="thm-btn w-100 mt-3 style-2">
                                    <span class="btn-wrap">
                                        <span>Kembali ke Toko</span>
                                        <span>Kembali ke Toko</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end checkout-section -->

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format nomor WhatsApp
        const noWaInput = document.getElementById('no_wa_penerima');
        if (noWaInput) {
            noWaInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                e.target.value = value;
            });
        }

        // Validasi form sebelum submit
        const checkoutForm = document.getElementById('checkoutForm');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                const namaPenerima = document.getElementById('nama_penerima');
                const noWaPenerima = document.getElementById('no_wa_penerima');
                const alamatPenerima = document.getElementById('alamat_penerima');

                if (!namaPenerima || !noWaPenerima || !alamatPenerima) {
                    e.preventDefault();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Perhatian!',
                            text: 'Mohon lengkapi semua field yang wajib diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert('Mohon lengkapi semua field yang wajib diisi');
                    }
                    return false;
                }

                const namaValue = namaPenerima.value.trim();
                const noWaValue = noWaPenerima.value.trim();
                const alamatValue = alamatPenerima.value.trim();

                if (!namaValue || !noWaValue || !alamatValue) {
                    e.preventDefault();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Perhatian!',
                            text: 'Mohon lengkapi semua field yang wajib diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert('Mohon lengkapi semua field yang wajib diisi');
                    }
                    return false;
                }

                if (noWaValue.length < 10) {
                    e.preventDefault();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Perhatian!',
                            text: 'Nomor WhatsApp harus minimal 10 digit',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert('Nomor WhatsApp harus minimal 10 digit');
                    }
                    return false;
                }
            });
        }
    });
</script>
@endsection

