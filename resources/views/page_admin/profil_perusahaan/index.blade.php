@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profil</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Data Profil</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Data Profil</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Data Profil</h5>
                @if($profils->count() === 0)
                <a href="{{ route('profil-perusahaan.create') }}" class="btn btn-primary">Tambah Data Profil</a>
                @endif
            </div>
            <div class="card-body">
              @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Perusahaan</th>
                      <th>No. Telepon</th>
                      <th>Logo Perusahaan</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Koordinat</th>
                      <th>Media Sosial</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($profils as $e => $profil)
                    <tr>
                      <td>{{ $e+1 }}</td>
                      <td>{{ $profil->nama_perusahaan }}</td>
                      <td>{{ $profil->no_telp_perusahaan }}</td>
                      <td>
                        <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="Logo Perusahaan" class="img-fluid" style="max-width: 100px;">
                      </td>
                      <td>{{ $profil->email_perusahaan }}</td>
                      <td>{{ $profil->alamat_perusahaan }}</td>
                      <td>{{ $profil->latitude }}, {{ $profil->longitude }}</td>
                      <td>
                        <div class="d-flex gap-2">
                          @if($profil->instagram_perusahaan)
                            <a href="{{ $profil->instagram_perusahaan }}" target="_blank" class="btn btn-sm btn-danger">
                              <i class="fab fa-instagram"></i>
                            </a>
                          @endif
                          @if($profil->facebook_perusahaan)
                            <a href="{{ $profil->facebook_perusahaan }}" target="_blank" class="btn btn-sm btn-primary">
                              <i class="fab fa-facebook-f"></i>
                            </a>
                          @endif
                          @if($profil->twitter_perusahaan)
                            <a href="{{ $profil->twitter_perusahaan }}" target="_blank" class="btn btn-sm btn-info">
                              <i class="fab fa-twitter"></i>
                            </a>
                          @endif
                          @if($profil->tiktok_perusahaan)
                            <a href="{{ $profil->tiktok_perusahaan }}" target="_blank" class="btn btn-sm btn-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z"/></svg>
                            </a>
                          @endif
                        </div>
                      </td>
                      <td>
                        <a href="{{ route('profil-perusahaan.show', $profil) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('profil-perusahaan.edit', $profil) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('profil-perusahaan.destroy', $profil) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Perusahaan</th>
                      <th>No. Telepon</th>
                      <th>Logo Perusahaan</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Koordinat</th>
                      <th>Media Sosial</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Zero config table end -->
      </div>
    </div>
  </section>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
  <script>
    $(document).ready(function() {
      $('#simpletable').DataTable();
    });
  </script>
  @endsection