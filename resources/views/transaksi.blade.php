@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
<div class="container-fluid py-4">
    <div class="row">
        <!-- Wrapper with Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <!-- Menu Items -->
                    <div class="col-lg-8">
                        <div class="col-lg-12">
                            <div class="row g-3 mb-3">
                                <form action="">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control w-25" name="search_produk" placeholder="Type here..." value="{{request('search_produk')}}">
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Scrollable Product List -->
                            <div class="row g-3 mb-3" style="max-height: 500px; overflow-y: auto;">
                                @foreach ($produk as $item)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="{{ \Storage::url($item->foto) }}" class="card-img-top" alt="{{ $item->name }}">
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

                    <!-- Current Order -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between">
                                    <span>Current Order</span>
                                    <button class="btn btn-sm btn-outline-danger" id="clear-all">Clear All</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group mb-3" id="order-list">
                                    <!-- Dynamic order list will appear here -->
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
                                <div class="d-flex justify-content-around mb-3">
                                    <button class="btn btn-outline-secondary">Cash</button>
                                    <button class="btn btn-outline-primary">Card</button>
                                    <button class="btn btn-outline-secondary">E-Wallet</button>
                                </div>
                                <button class="btn btn-primary w-100" id="print-bill">Print Bills</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>
</div>

<!-- JavaScript to handle adding items to the current order -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the order and subtotal variables
        let orderItems = [];
        let subtotal = 0;

        // Handle adding items to the order
        document.querySelectorAll('.add-to-order').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let name = this.getAttribute('data-nama');
                let price = parseFloat(this.getAttribute('data-harga'));

                // Check if the product is already in the order
                let existingItem = orderItems.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    orderItems.push({ id, name, price, quantity: 1 });
                }

                // Update the order display
                updateOrder();
            });
        });

        // Handle clearing all items
        document.getElementById('clear-all').addEventListener('click', function() {
            orderItems = [];
            updateOrder();
        });

        // Handle discount input change
        document.getElementById('discount-input').addEventListener('input', function() {
            updateOrder();
        });

        // Update the order list and totals
        function updateOrder() {
            // Clear the current order display
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = '';

            // Update subtotal and total
            subtotal = 0;
            orderItems.forEach(item => {
                subtotal += item.price * item.quantity;

                // Add each item to the order list
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                listItem.innerHTML = `
                    <div>
                        <strong>${item.name}</strong>
                        <span class="badge bg-secondary">x${item.quantity}</span>
                    </div>
                    <span>Rp ${item.price * item.quantity}</span>
                `;
                orderList.appendChild(listItem);
            });

            // Get discount value from input
            let discount = parseFloat(document.getElementById('discount-input').value) || 0;
            discount = Math.min(discount, subtotal); // Ensure discount doesn't exceed subtotal

            // Calculate tax and total
            const total = subtotal - discount;

            // Update the display
            document.getElementById('subtotal').textContent = `Rp ${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `Rp ${total.toFixed(2)}`;
        }
    });
</script>
@endsection
