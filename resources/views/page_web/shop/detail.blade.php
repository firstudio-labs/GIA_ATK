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
                        <span>{{ $produk->judul }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- start shop-single-section -->
    <section class="shop-single-section pb-70">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-single-wrap mb-30">
                        <div class="product_details_img">
                            <div class="tab-content" id="myTabContent">
                                @php
                                    $gambars = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0 
                                        ? $produk->gambar_produk 
                                        : [];
                                @endphp
                                @if(count($gambars) > 0)
                                    @foreach($gambars as $idx => $gambar)
                                        <div class="tab-pane {{ $idx === 0 ? 'show active' : '' }}" id="thumb{{ $idx + 1 }}" role="tabpanel" aria-labelledby="thumb{{ $idx + 1 }}-tab">
                                            <div class="pl_thumb">
                                                <img src="{{ asset('produk/gambar/' . $gambar) }}" alt="{{ $produk->judul }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="tab-pane show active" id="thumb1" role="tabpanel" aria-labelledby="thumb1-tab">
                                        <div class="pl_thumb">
                                            <img src="{{ asset('web/assets/img/shop/details.jpg') }}" alt="{{ $produk->judul }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(count($gambars) > 1)
                            <div class="shop_thumb_tab">
                                <ul class="nav" id="myTab2" role="tablist">
                                    @foreach($gambars as $idx => $gambar)
                                        <li class="nav-item">
                                            <button class="nav-link {{ $idx === 0 ? 'active' : '' }}" id="thumb{{ $idx + 1 }}-tab" data-bs-toggle="tab" data-bs-target="#thumb{{ $idx + 1 }}" type="button" role="tab" aria-controls="thumb{{ $idx + 1 }}" aria-selected="{{ $idx === 0 ? 'true' : 'false' }}">
                                                <img src="{{ asset('produk/gambar/' . $gambar) }}" alt="Thumbnail {{ $idx + 1 }}">
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 product-details-col">
                    <div class="product-details">
                        <h2>{{ $produk->judul }}</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="price">
                            @if($produk->diskon > 0)
                                @php
                                    $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon / 100);
                                @endphp
                                <span class="current">Rp {{ number_format($hargaDiskon, 0, ',', '.') }}</span>
                                <span class="old">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @else
                                <span class="current">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <p>{{ \Illuminate\Support\Str::limit($produk->deskripsi, 200) }}</p>

                        @if($produk->kategori || $produk->subKategori)
                            <div class="thb-product-meta-before mt-20">
                                <div class="product_meta">
                                    @if($produk->kategori)
                                        <span class="posted_in">Kategori: <a href="#!">{{ $produk->kategori->nama_kategori }}</a></span>
                                    @endif
                                    @if($produk->subKategori)
                                        <span class="tagged_as">Sub Kategori: <a href="#!">{{ $produk->subKategori->first_nama_sub_kategori ?? '' }} {{ $produk->subKategori->second_nama_sub_kategori ?? '' }}</a></span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="product-option">
                            <form class="form" id="addToCartForm" onsubmit="return false;">
                                <div class="product-row d-flex" style="align-items:flex-start; gap:30px;">
                                    <div style="margin-top:12px;">
                                        <input class="form-control" type="number" min="1" max="999" value="1" name="quantity" id="quantity" style="width:80px; height:38px;">
                                    </div>
                                    <div class="add-to-cart-btn" style="margin-bottom:0px; margin-top:0;">
                                        @auth
                                            <button type="button" id="addToCartBtn" class="thm-btn thm-btn__2 no-icon" data-produk-id="{{ $produk->id }}" style="height:46px;">
                                                <span class="btn-wrap"> 
                                                    <span>Masukkan Keranjang</span>
                                                    <span>Masukkan Keranjang</span>
                                                </span>
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="thm-btn thm-btn__2 no-icon" style="height:56px;">
                                                <span class="btn-wrap"> 
                                                    <span>Masukkan Keranjang</span>
                                                    <span>Masukkan Keranjang</span>
                                                </span>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col col-xs-12">
                    <div class="single-product-info">
                        <!-- Nav tabs -->
                        <div class="tablist">
                            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                                <li><button class="active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#tb-01">Deskripsi</button></li>
                                <li><button id="tab-two" data-bs-toggle="pill" data-bs-target="#tb-02">Informasi Tambahan</button></li>
                            </ul>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="tb-01">
                                <h3>Deskripsi Produk</h3>
                                <p>{!! nl2br(e($produk->deskripsi)) !!}</p>
                                @if($produk->berat || $produk->ukuran || $produk->warna)
                                    <div class="description-list-items mt-4">
                                        <ul class="description-list">
                                            @if($produk->berat)
                                                <li>
                                                    Berat: <span>{{ $produk->berat }} kg</span>
                                                </li>
                                            @endif
                                            @if($produk->ukuran)
                                                <li>
                                                    Ukuran: <span>{{ $produk->ukuran }}</span>
                                                </li>
                                            @endif
                                            @if($produk->warna)
                                                <li>
                                                    Warna: <span>{{ $produk->warna }}</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="tb-02">
                                <div class="table-responsive mb-15">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>SKU</td>
                                                <td>{{ $produk->sku }}</td>
                                            </tr>
                                            @if($produk->berat)
                                                <tr>
                                                    <td>Berat</td>
                                                    <td>{{ $produk->berat }} kg</td>
                                                </tr>
                                            @endif
                                            @if($produk->ukuran)
                                                <tr>
                                                    <td>Ukuran</td>
                                                    <td>{{ $produk->ukuran }}</td>
                                                </tr>
                                            @endif
                                            @if($produk->warna)
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>{{ $produk->warna }}</td>
                                                </tr>
                                            @endif
                                            @if($produk->kategori)
                                                <tr>
                                                    <td>Kategori</td>
                                                    <td>{{ $produk->kategori->nama_kategori }}</td>
                                                </tr>
                                            @endif
                                            @if($produk->subKategori)
                                                <tr>
                                                    <td>Sub Kategori</td>
                                                    <td>{{ $produk->subKategori->first_nama_sub_kategori ?? '' }} {{ $produk->subKategori->second_nama_sub_kategori ?? '' }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>Harga</td>
                                                <td>
                                                    @if($produk->diskon > 0)
                                                        @php
                                                            $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon / 100);
                                                        @endphp
                                                        Rp {{ number_format($hargaDiskon, 0, ',', '.') }} 
                                                        <del style="color: #999;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</del>
                                                        <span class="badge bg-danger">Diskon {{ $produk->diskon }}%</span>
                                                    @else
                                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

            @if($relatedProduks->count() > 0)
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="realted-porduct">
                            <h3>Produk Terkait</h3>
                            <div class="shop-area">
                                <ul class="products clearfix">
                                    @foreach($relatedProduks as $relatedProduk)
                                        <li class="product">
                                            <div class="product-holder">
                                                @php
                                                    $gambar = is_array($relatedProduk->gambar_produk) && count($relatedProduk->gambar_produk) > 0 
                                                        ? asset('produk/gambar/' . $relatedProduk->gambar_produk[0])
                                                        : asset('web/assets/img/product/p-1.jpg');
                                                @endphp
                                                <a href="{{ route('shop.detail', $relatedProduk->slug) }}">
                                                    <img src="{{ $gambar }}" alt="{{ $relatedProduk->judul }}">
                                                </a>
                                                <ul class="product__action">
                                                    <li>
                                                        <a href="{{ route('shop.detail', $relatedProduk->slug) }}">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                                        @php
                                                            $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                                            $pesan = "Halo, saya tertarik dengan produk: " . $relatedProduk->judul;
                                                            $waLink = "https://wa.me/" . $no_wa_clean . "?text=" . urlencode($pesan);
                                                        @endphp
                                                        <li>
                                                            <a href="{{ $waLink }}" target="_blank">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="product-info">
                                                <div class="product__review ul_li">
                                                    <ul class="rating-star ul_li mr-10">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product__title">
                                                    <a href="{{ route('shop.detail', $relatedProduk->slug) }}">{{ $relatedProduk->judul }}</a>
                                                </h2>
                                                <h4 class="product__price">
                                                    @if($relatedProduk->diskon > 0)
                                                        @php
                                                            $hargaDiskonRelated = $relatedProduk->harga - ($relatedProduk->harga * $relatedProduk->diskon / 100);
                                                        @endphp
                                                        <span class="new">Rp {{ number_format($hargaDiskonRelated, 0, ',', '.') }}</span>
                                                        <span class="old">Rp {{ number_format($relatedProduk->harga, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="new">Rp {{ number_format($relatedProduk->harga, 0, ',', '.') }}</span>
                                                    @endif
                                                </h4>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div> <!-- end of container -->
    </section>
    <!-- end of shop-single-section -->

@endsection

@section('script')
<script>
    // Quantity Button Handler
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInput = document.querySelector('.product-count');
        
        // Create quantity controls if needed
        if (qtyInput) {
            // Add minus button functionality
            const minusBtn = document.createElement('button');
            minusBtn.type = 'button';
            minusBtn.className = 'qtyminus';
            minusBtn.innerHTML = '-';
            minusBtn.style.cssText = 'width: 30px; height: 30px; border: 1px solid #ddd; background: #f5f5f5; cursor: pointer;';
            
            // Add plus button functionality
            const plusBtn = document.createElement('button');
            plusBtn.type = 'button';
            plusBtn.className = 'qtyplus';
            plusBtn.innerHTML = '+';
            plusBtn.style.cssText = 'width: 30px; height: 30px; border: 1px solid #ddd; background: #f5f5f5; cursor: pointer;';
            
            // Wrap input with buttons
            const qtyWrapper = qtyInput.parentElement;
            if (qtyWrapper) {
                qtyWrapper.style.display = 'flex';
                qtyWrapper.insertBefore(minusBtn, qtyInput);
                qtyWrapper.appendChild(plusBtn);
                
                minusBtn.addEventListener('click', function() {
                    let currentVal = parseInt(qtyInput.value) || 1;
                    if (currentVal > 1) {
                        qtyInput.value = currentVal - 1;
                    }
                });
                
                plusBtn.addEventListener('click', function() {
                    let currentVal = parseInt(qtyInput.value) || 1;
                    qtyInput.value = currentVal + 1;
                });
            }
        }

        // Add to Cart Handler
        const addToCartBtn = document.getElementById('addToCartBtn');
        const addToCartForm = document.getElementById('addToCartForm');
        
        // Prevent form submission
        if (addToCartForm) {
            addToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                return false;
            });
        }
        
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const produkId = this.getAttribute('data-produk-id');
                const quantityInput = document.getElementById('quantity');
                const quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;
                
                if (!produkId) {
                    console.error('Produk ID tidak ditemukan');
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Produk ID tidak ditemukan',
                            icon: 'error'
                        });
                    } else {
                        alert('Error: Produk ID tidak ditemukan');
                    }
                    return;
                }
                
                console.log('Adding to cart:', { produkId, quantity });
                
                // Disable button
                this.disabled = true;
                const originalHTML = this.innerHTML;
                this.innerHTML = '<span class="btn-wrap"><span>Menambahkan...</span><span>Menambahkan...</span></span>';

                fetch('{{ route("keranjang.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        produk_id: produkId,
                        quantity: quantity
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        return response.json().then(data => {
                            console.error('Error response:', data);
                            throw new Error(data.message || 'Gagal menambahkan produk ke keranjang');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success data:', data);
                    if (data.success) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message || 'Produk berhasil ditambahkan ke keranjang',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            alert('Berhasil! ' + (data.message || 'Produk berhasil ditambahkan ke keranjang'));
                        }
                        
                        // Reload cart sidebar
                        if (typeof loadCart === 'function') {
                            loadCart();
                        }
                        // Update cart count in header
                        if (typeof updateCartCount === 'function') {
                            updateCartCount();
                        }
                        // Dispatch custom event for cart update
                        document.dispatchEvent(new CustomEvent('cartUpdated'));
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Gagal!',
                                text: data.message || 'Gagal menambahkan produk ke keranjang',
                                icon: 'error'
                            });
                        } else {
                            alert('Gagal! ' + (data.message || 'Gagal menambahkan produk ke keranjang'));
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'Terjadi kesalahan saat menambahkan produk ke keranjang',
                            icon: 'error'
                        });
                    } else {
                        alert('Error! ' + (error.message || 'Terjadi kesalahan saat menambahkan produk ke keranjang'));
                    }
                })
                .finally(() => {
                    // Re-enable button
                    this.disabled = false;
                    this.innerHTML = originalHTML;
                });
            });
        } else {
            console.warn('Add to cart button not found');
        }
    });
</script>
@endsection