<!-- sidebar-info start -->
<div id="targetElement" class="cart_sidebar">
    <button type="button" id="closeButton" class="cart_close_btn"><i class="fal fa-times"></i></button>
    <h2 class="heading_title text-uppercase">Keranjang Belanja - <span id="cartCount">0</span></h2>
    <div class="cart_items_list" id="cartItems">
        <div class="text-center py-5">
            <p class="text-muted">Memuat keranjang...</p>
        </div>
    </div>
    <div class="total_price text-uppercase" id="cartTotal" style="display: none;">
        <span>Sub Total:</span>
        <span id="subtotalAmount">Rp 0</span>
    </div>
    <div class="d-flex flex-column gap-2 align-items-stretch" id="cartButtons" style="display: none; margin-top: 24px;">
        <a href="{{ route('shop') }}" class="thm-btn w-100" style="min-width:160px;">
            <span class="btn-wrap">
                <span>Lihat Semua Produk</span>
                <span>Lihat Semua Produk</span>
            </span>
        </a>
        <a href="#" 
           class="thm-btn thm-btn__black w-100" 
           style="min-width:160px;" 
           onclick="event.preventDefault(); lanjutkanPesanan();">
            <span class="btn-wrap">
                <span>Lanjutkan Pesanan</span>
                <span>Lanjutkan Pesanan</span>
            </span>
        </a>
    </div>
</div>
<!-- sidebar-info end -->

<script>
    function loadCart() {
        fetch('{{ route("keranjang.get") }}', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            const cartButtons = document.getElementById('cartButtons');
            const cartCount = document.getElementById('cartCount');
            
            if (data.items && data.items.length > 0) {
                let html = '';
                
                data.items.forEach(item => {
                    const totalHarga = item.harga * item.quantity;
                    html += `
                        <div class="cart_item" data-cart-id="${item.id}">
                            <div class="item_image">
                                <a href="{{ url('/shop') }}/${item.slug}">
                                    <img src="${item.gambar}" alt="${item.judul}">
                                </a>
                            </div>
                            <div class="item_content">
                                <h4 class="item_title">
                                    <a href="{{ url('/shop') }}/${item.slug}">${item.judul}</a>
                                </h4>
                                <span class="item_price">Rp ${formatNumber(totalHarga)} <small>(x${item.quantity})</small></span>
                                <button type="button" class="remove_btn" onclick="removeFromCart(${item.id})">
                                    <i class="fal fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
                
                cartItems.innerHTML = html;
                
                // Update subtotal
                document.getElementById('subtotalAmount').textContent = 'Rp ' + formatNumber(data.subtotal);
                cartCount.textContent = data.items.length;
                
                // Show total and buttons
                cartTotal.style.display = 'flex';
                cartButtons.style.display = 'flex';
            } else {
                cartItems.innerHTML = `
                    <div class="text-center py-5">
                        <p class="text-muted">Keranjang Anda kosong</p>
                        <a href="{{ route('shop') }}" class="thm-btn mt-3">
                            <span class="btn-wrap">
                                <span>Mulai Belanja</span>
                                <span>Mulai Belanja</span>
                            </span>
                        </a>
                    </div>
                `;
                cartCount.textContent = '0';
                
                // Hide total and buttons
                cartTotal.style.display = 'none';
                cartButtons.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error loading cart:', error);
            document.getElementById('cartItems').innerHTML = `
                <div class="text-center py-5">
                    <p class="text-danger">Gagal memuat keranjang</p>
                </div>
            `;
        });
    }

    function removeFromCart(cartId) {
        Swal.fire({
            title: 'Hapus Produk?',
            text: 'Apakah Anda yakin ingin menghapus produk ini dari keranjang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('/keranjang') }}/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message || 'Produk berhasil dihapus dari keranjang',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        loadCart();
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message || 'Gagal menghapus produk dari keranjang',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus produk',
                        icon: 'error'
                    });
                });
            }
        });
    }

    function lanjutkanPesanan() {
        @auth
            // Redirect ke halaman checkout
            window.location.href = '{{ route("pesanan.checkout") }}';
        @else
            window.location.href = '{{ route("login") }}';
        @endauth
    }

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Load cart on page load and when sidebar opens
    document.addEventListener('DOMContentLoaded', function() {
        loadCart();
        
        // Reload cart when sidebar opens
        const openButton = document.getElementById('openButton');
        if (openButton) {
            openButton.addEventListener('click', function() {
                setTimeout(loadCart, 100); // Small delay to ensure sidebar is visible
            });
        }
    });
</script>