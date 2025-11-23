@extends('template_web.layout')
@section('content')

<!--<< Breadcrumb Section Start >>-->
<div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
    <div class="container">
        <div class="page-heading">
            <div class="breadcrumb-sub-title text-center">
                <h1 class="wow fadeInUp" data-wow-delay=".3s">Checkout</h1>
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                    <li>
                        <a href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li>
                        <i class="fal fa-minus"></i>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}">Produk</a>
                    </li>
                    <li>
                        <i class="fal fa-minus"></i>
                    </li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Section Start -->
<section class="shop-details-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form-wrapper">
                    @if(isset($pesanan))
                        <div class="alert alert-success">
                            <h4><i class="fas fa-check-circle"></i> Pesanan Berhasil Dibuat!</h4>
                            <p class="mb-2"><strong>ID Pesanan:</strong> #{{ $pesanan->id }}</p>
                            <p class="mb-2"><strong>Nama Penerima:</strong> {{ $request->nama_penerima }}</p>
                            <p class="mb-2"><strong>No. WhatsApp:</strong> {{ $request->no_wa_penerima }}</p>
                            <p class="mb-0"><strong>Alamat:</strong> {{ $request->alamat_penerima }}</p>
                        </div>
                        <div class="alert alert-info">
                            <p class="mb-0">Klik tombol di bawah untuk melanjutkan ke WhatsApp dan mengirim detail pesanan.</p>
                        </div>
                    @else
                        <h3 class="mb-4">Detail Penerima</h3>
                        <form action="{{ route('pesanan.process') }}" method="POST" id="checkoutForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nama_penerima" class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror" 
                                        id="nama_penerima" name="nama_penerima" 
                                        value="{{ old('nama_penerima', $user->name ?? '') }}" required>
                                    @error('nama_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="no_wa_penerima" class="form-label">No. WhatsApp Penerima <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_wa_penerima') is-invalid @enderror" 
                                        id="no_wa_penerima" name="no_wa_penerima" 
                                        value="{{ old('no_wa_penerima', $user->no_wa ?? '') }}" 
                                        placeholder="08xxxxxxxxxx" required>
                                    @error('no_wa_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alamat_penerima" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat_penerima') is-invalid @enderror" 
                                        id="alamat_penerima" name="alamat_penerima" rows="4" required>{{ old('alamat_penerima') }}</textarea>
                                    @error('alamat_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-summary">
                    <h3 class="mb-4">Ringkasan Pesanan</h3>
                    <div class="order-items mb-4">
                        @foreach($items as $item)
                            <div class="order-item d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
                                <div class="item-info flex-grow-1">
                                    <h6 class="mb-1">{{ $item['judul'] }}</h6>
                                    <p class="text-muted mb-0 small">
                                        {{ $item['quantity'] }} x Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="item-total">
                                    <strong>Rp {{ number_format($item['total'], 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="order-total">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span>Subtotal:</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span>Total Item:</span>
                            <span>{{ $totalQuantity }} item</span>
                        </div>
                        <div class="total-amount d-flex justify-content-between align-items-center pt-3 border-top">
                            <h5 class="mb-0">Total:</h5>
                            <h4 class="mb-0 text-primary">Rp {{ number_format($subtotal, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                    @if(isset($pesanan) && isset($whatsappLink))
                        <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="theme-btn w-100 mt-4" style="background-color:#25D366; border: none; color:#fff;">
                            <i class="fab fa-whatsapp"></i> Lanjutkan Pemesanan via WhatsApp
                        </a>
                    @else
                        <button type="submit" form="checkoutForm" class="theme-btn w-100 mt-4" style="background-color:#25D366; border: none; color:#fff;">
                            <i class="fab fa-whatsapp"></i> Lanjutkan Pemesanan via WhatsApp
                        </button>
                    @endif
                    <a href="{{ route('shop') }}" class="theme-btn w-100 mt-2 style-2">
                        Kembali ke Toko
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
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
            const namaPenerima = document.getElementById('nama_penerima').value.trim();
            const noWaPenerima = document.getElementById('no_wa_penerima').value.trim();
            const alamatPenerima = document.getElementById('alamat_penerima').value.trim();

            if (!namaPenerima || !noWaPenerima || !alamatPenerima) {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Mohon lengkapi semua field yang wajib diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (noWaPenerima.length < 10) {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Nomor WhatsApp harus minimal 10 digit',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false;
            }
        });
    }

</script>
@endsection

