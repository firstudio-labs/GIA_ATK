@php
    $info = \App\Models\ManageInfo::where('status', 'aktif')->where('tipe', 'popup')->first();
@endphp
@if($info)
<!-- start newsletter-popup-area-section -->
<section class="newsletter-popup-area-section" style="display: block;">
    <div class="newsletter-popup-area">
        <div class="newsletter-popup-ineer">
            <button class="btn newsletter-close-btn" onclick="document.querySelector('.newsletter-popup-area-section').style.display='none'" aria-label="Tutup popup">
                <i class="fal fa-times"></i>
            </button>
            <div class="img-holder">
                @if($info->gambar)
                    <img src="{{ asset('info/gambar/'.$info->gambar) }}" alt="{{ $info->judul ?? 'Popup Image' }}">
                @else
                    <img src="{{ asset('web/assets/img/bg/newsletter.jpg') }}" alt="Popup Image">
                @endif
            </div>
            <div class="details">
                <h4>{{ $info->judul }}</h4>
                <p>{!! nl2br(e($info->deskripsi)) !!}</p>
            </div>
        </div>
    </div> 
</section>
<!-- end newsletter-popup-area-section -->
@endif