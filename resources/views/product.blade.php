@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Product'])
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Product Table</h6>
                </div>
                <form action="">
                    <div class="input-group px-4 mb-3">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control w-25" name="search_produk" placeholder="Type here..." value="{{request('search_produk')}}">
                    </div>
                    <div class="px-4">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Produk</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Harga</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stok</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                                @foreach ($produk as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if ($item->foto)
                                                <img src="{{ \Storage::url($item->foto) }}" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->nama_produk }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($item->harga,2) }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if($item->stok == 0)
                                        <span class="badge badge-sm bg-gradient-danger">{{ number_format($item->stok) }}</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-success">{{ number_format($item->stok) }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $item->id }}">Edit Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('produk.update', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3 " style="display: none;">
                                                        <label for="idProduk{{ $item->id }}" class="form-label">Id Produk</label>
                                                        <input type="text" class="form-control" id="idProduk{{ $item->id }}" name="id" value="{{ $item->id }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="namaProduk{{ $item->id }}" class="form-label">Nama Produk</label>
                                                        <input type="text" class="form-control" id="namaProduk{{ $item->id }}" name="nama_produk" value="{{ $item->nama_produk }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="hargaProduk{{ $item->id }}" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="hargaProduk{{ $item->id }}" name="harga" value="{{ $item->harga }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="stokProduk{{ $item->id }}" class="form-label">Stok</label>
                                                        <input type="number" class="form-control" id="stokProduk{{ $item->id }}" name="stok" value="{{ $item->stok }}" required>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                            <div>
                                {{ $produk->links() }}
                            </div>
                            <div>
                                <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah">Tambah Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="foto">Foto Produk (jpg,jpeg,png)</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" name="nama_produk" placeholder="Masukkan nama produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="hargaProduk" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="hargaProduk" name="harga" placeholder="Masukkan harga produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="stokProduk" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stokProduk" name="stok" placeholder="Masukkan jumlah stok" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection