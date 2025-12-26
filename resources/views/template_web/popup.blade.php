@php
    $info = \App\Models\ManageInfo::where('status', 'aktif')->where('tipe', 'popup')->first();
@endphp
@if($info)
<!-- start newsletter-popup-area-section -->
<section class="newsletter-popup-area-section" style="display: block;">
    <div class="newsletter-popup-overlay"></div>
    <div class="newsletter-popup-area">
        <div class="newsletter-popup-container">
            <button class="newsletter-popup-close" onclick="document.querySelector('.newsletter-popup-area-section').style.display='none'" aria-label="Tutup popup">
                <i class="fal fa-times"></i>
            </button>

            <div class="newsletter-popup-content">
                <div class="newsletter-popup-image">
                    @if($info->gambar)
                        <img src="{{ asset('info/gambar/'.$info->gambar) }}" alt="{{ $info->judul ?? 'Popup Image' }}">
                    @else
                        <img src="{{ asset('web/assets/img/bg/newsletter.jpg') }}" alt="Popup Image">
                    @endif
                </div>

                <div class="newsletter-popup-text">
                    <h3 class="newsletter-popup-title">{{ $info->judul }}</h3>
                    <div class="newsletter-popup-description">
                        {!! nl2br(e($info->deskripsi)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end newsletter-popup-area-section -->
@endif