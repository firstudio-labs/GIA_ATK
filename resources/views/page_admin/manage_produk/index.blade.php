@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
   
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Manage Produk</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Data Produk</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Produk</h5>
                <a href="{{ route('manage-produk.create') }}" class="btn btn-primary">Tambah Produk</a>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Kategori</th>
                      <th>Sub Kategori</th>
                      <th>Harga</th>
                      <th>Status</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($produks as $e => $produk)
                    <tr>
                      <td>{{ $e+1 }}</td>
                      <td>{{ $produk->judul }}</td>
                      <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                      <td>{{ $produk->subKategori->first_nama_sub_kategori ?? '-' }}</td>
                      <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                      <td><span class="badge {{ $produk->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($produk->status) }}</span></td>
                      <td>{{ is_array($produk->gambar_produk) ? count($produk->gambar_produk) : 0 }}</td>
                      <td>
                        <a href="{{ route('manage-produk.show', $produk->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('manage-produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('manage-produk.destroy', $produk->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                      <th>Judul</th>
                      <th>Kategori</th>
                      <th>Sub Kategori</th>
                      <th>Harga</th>
                      <th>Status</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
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
                    text: 'Data ini akan dihapus secara permanen!',
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
  $(document).ready(function() { $('#simpletable').DataTable(); });
</script>
@endsection

