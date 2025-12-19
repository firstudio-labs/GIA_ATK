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
                        <span>Profil Saya</span>
                        </li>
                    </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- account start -->
    <section class="account pb-90">
        <div class="container">
            <div class="row mt-none-30">
                    <!-- Form Edit Profil -->
                <div class="col-lg-8 mt-30">
                    <div class="account__wrap pr-60 pr-xs-0">
                        <h2 class="account__title">Edit Profil</h2>
                                <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                        <!-- Foto Profile -->
                            <div class="account__input-field text-center mb-4">
                                <div class="position-relative d-inline-block mb-3">
                                                @php
                                                    $isUrl = filter_var($data->foto_profile, FILTER_VALIDATE_URL);
                                                @endphp
                                                @if($data->foto_profile && ($isUrl || file_exists(public_path('uploads/foto_profile/' . $data->foto_profile))))
                                                    <img src="{{ $isUrl ? $data->foto_profile : asset('uploads/foto_profile/' . $data->foto_profile) }}" 
                                                         alt="Foto Profile" 
                                                         class="rounded-circle" 
                                             id="previewImage"
                                             style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--color-primary);">
                                                @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                             id="previewImage"
                                             style="width: 150px; height: 150px; background-color: var(--color-primary); color: #fff; border: 4px solid var(--color-primary); font-size: 48px; font-weight: bold;">
                                                        {{ strtoupper(substr($data->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                <label for="foto_profile">Ubah Foto Profile</label>
                                                <input type="file" 
                                                       id="foto_profile" 
                                                       name="foto_profile" 
                                                       accept="image/*"
                                       onchange="previewImage(this)"
                                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF, SVG (Max: 2MB)</small>
                                                @error('foto_profile')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                        </div>

                                        <!-- Nama -->
                            <div class="account__input-field">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   id="name" 
                                                   name="name" 
                                       placeholder="Masukkan nama lengkap"
                                                   value="{{ old('name', $data->name) }}" 
                                                   required>
                                            @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Username -->
                            <div class="account__input-field">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   id="username" 
                                                   name="username" 
                                       placeholder="Masukkan username"
                                                   value="{{ old('username', $data->username) }}" 
                                                   required>
                                            @error('username')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                            <div class="account__input-field">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" 
                                                   id="email" 
                                                   name="email" 
                                       placeholder="Masukkan email"
                                                   value="{{ old('email', $data->email) }}" 
                                                   required>
                                            @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- No WhatsApp -->
                            <div class="account__input-field">
                                <label for="no_wa">No. WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   id="no_wa" 
                                                   name="no_wa" 
                                       placeholder="Masukkan nomor WhatsApp"
                                                   value="{{ old('no_wa', $data->no_wa) }}" 
                                                   required>
                                            @error('no_wa')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                            <div class="account__btn">
                                <button type="submit" class="thm-btn thm-btn__2">
                                    <span class="btn-wrap">
                                        <span>Simpan Perubahan</span>
                                        <span>Simpan Perubahan</span>
                                    </span>
                                            </button>
                            </div>
                        </form>
                        </div>
                    </div>

                <!-- Form Ubah Password & Info -->
                <div class="col-lg-4 mt-30">
                    <!-- Form Ubah Password -->
                    <div class="account__wrap mb-4">
                        <h2 class="account__title">Ubah Password</h2>
                                <form action="{{ route('profil.update-password') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                            <div class="account__input-field">
                                <label for="current_password">Password Lama <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               id="current_password" 
                                               name="current_password" 
                                       placeholder="Masukkan password lama"
                                               required>
                                        @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                            <div class="account__input-field">
                                <label for="password">Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               id="password" 
                                               name="password" 
                                       placeholder="Masukkan password baru"
                                               required>
                                <small class="text-muted d-block mt-1">Minimal 8 karakter</small>
                                        @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                            <div class="account__input-field">
                                <label for="password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                       placeholder="Konfirmasi password baru"
                                               required>
                                    </div>

                            <div class="account__btn">
                                <button type="submit" class="thm-btn thm-btn__2">
                                    <span class="btn-wrap">
                                        <span>Ubah Password</span>
                                        <span>Ubah Password</span>
                                    </span>
                                    </button>
                            </div>
                        </form>
                        </div>

                        <!-- Info Card -->
                    <div class="account__wrap">
                        <h2 class="account__title">Informasi Akun</h2>
                        <div class="account__info">
                            <p class="mb-3">
                                <strong>Bergabung sejak:</strong><br>
                                <span>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span>
                                </p>
                            <div class="account__btn">
                                <a href="{{ route('riwayat-pesanan.index') }}" class="thm-btn thm-btn__2">
                                    <span class="btn-wrap">
                                        <span>Riwayat Pesanan</span>
                                        <span>Riwayat Pesanan</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account end -->

@endsection

@section('script')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('previewImage');
                if (preview) {
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        // If it's a div, replace with img
                        var img = document.createElement('img');
                    img.src = e.target.result;
                        img.className = 'rounded-circle';
                        img.style.cssText = 'width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--color-primary);';
                        img.id = 'previewImage';
                        preview.parentNode.replaceChild(img, preview);
                    }
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
