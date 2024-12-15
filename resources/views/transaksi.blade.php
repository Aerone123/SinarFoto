@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Transaksi'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="col-lg-12">
                            <div class="row g-3 mb-3">
                                <form action="">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control w-25" name="search_produk" placeholder="Ketik di sini..." value="{{request('search_produk')}}">
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row g-3 mb-3" style="max-height: 500px; overflow-y: auto;">
                                @foreach ($produk as $item)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="{{ \Storage::url($item->foto) }}" class="card-img-top" alt="{{ $item->name }}" style="max-height: 150px;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                            <p class="text-success fw-bold">Rp {{ number_format($item->harga, 2) }}</p>
                                            <button class="btn btn-success btn-sm add-to-order" data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}" data-harga="{{ $item->harga }}">+ Add</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between">
                                    <span>Order Saat Ini</span>
                                    <button class="btn btn-sm btn-outline-danger" id="clear-all">Bersihkan semua</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group mb-3" id="order-list">
                                </ul>
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal:</span>
                                    <span id="subtotal">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Discount:</span>
                                    <input type="number" id="discount-input" class="form-control w-25" value="0" min="0" placeholder="Rp 0" />
                                </div>
                                <div class="d-flex justify-content-between fw-bold mt-2">
                                    <span>Total:</span>
                                    <span class="text-success" id="total">Rp 0</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" id="add-transaction">Tambah Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Transaksi Table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Diskon</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                                @foreach ($transaksi as $item)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->tanggal }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item->diskon,2) }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Rp. {{ number_format($item->total_pembayaran,2) }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $item->id }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                            <div>
                                {{ $transaksi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>

@foreach ($transaksi as $item)
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $item->id }}">Detail Transaksi Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>ID Transaksi</h6>
                    <p>{{ $item->id }}</p>
                    <h6>Tanggal Transaksi</h6>
                    <p>{{ $item->tanggal }}</p>
                    <h6>Diskon</h6>
                    <p>Rp. {{ number_format($item->diskon,2) }}</p>
                    <h6>Total Pembayaran</h6>
                    <p>Rp. {{ number_format($item->total_pembayaran,2) }}</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->detailtransaksi as $detailTransaksi)
                            <tr>
                                <td>{{ $detailTransaksi->produk->nama_produk }}</td>
                                <td>{{ $detailTransaksi->jumlah }}</td>
                                <td>Rp {{ number_format($detailTransaksi->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let orderItems = [];
        let subtotal = 0;

        document.querySelectorAll('.add-to-order').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let name = this.getAttribute('data-nama');
                let price = parseFloat(this.getAttribute('data-harga'));

                let existingItem = orderItems.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    orderItems.push({
                        id,
                        name,
                        price,
                        quantity: 1
                    });
                }

                updateOrder();
            });
        });

        document.getElementById('clear-all').addEventListener('click', function() {
            orderItems = [];
            updateOrder();
        });

        document.getElementById('discount-input').addEventListener('input', function() {
            updateOrder();
        });

        function updateOrder() {
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = '';

            subtotal = 0;
            orderItems.forEach(item => {
                subtotal += item.price * item.quantity;

                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                listItem.innerHTML = `
                    <div>
                        <strong>${item.name}</strong>
                        <span class="badge bg-secondary" style="margin-right: 10px;">x${item.quantity}</span>
                        <button class="btn btn-sm btn-danger remove-from-order" data-id="${item.id}" style="margin: auto;"><i class="ni ni-fat-delete"></i></button>
                    </div>
                    <span>Rp ${item.price * item.quantity}</span>
                `;
                orderList.appendChild(listItem);
            });

            let discount = parseFloat(document.getElementById('discount-input').value) || 0;
            discount = Math.min(discount, subtotal);

            const total = subtotal - discount;

            document.getElementById('subtotal').textContent = `Rp ${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `Rp ${total.toFixed(2)}`;

            document.querySelectorAll('.remove-from-order').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let existingItem = orderItems.find(item => item.id === id);
                    if (existingItem) {
                        existingItem.quantity--;
                        if (existingItem.quantity <= 0) {
                            orderItems = orderItems.filter(item => item.id !== id);
                        }
                        updateOrder();
                    }
                });
            });
        }

        document.getElementById('add-transaction').addEventListener('click', function() {
            const discount = parseFloat(document.getElementById('discount-input').value) || 0;
            const total = parseFloat(document.getElementById('total').textContent.replace('Rp ', '').replace(',', '').trim());

            if (orderItems.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tidak ada produk dalam transaksi.'
                });
                return;
            }

            const orderData = {
                tanggal: new Date().toISOString().split('T')[0],
                total_pembayaran: total,
                diskon: discount,
                items: orderItems.map(item => ({
                    produk_id: item.id,
                    jumlah: item.quantity,
                    subtotal: item.price * item.quantity
                }))
            };

            fetch("{{ route('transaksi.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Transaksi berhasil ditambahkan.'
                        }).then(() => {
                            orderItems = [];
                            updateOrder();
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error || 'Unknown error'
                        });
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menambahkan transaksi.'
                    });
                });
        });
    });
</script>
@endsection