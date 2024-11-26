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
                            <div class="row g-3">
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
                            <div class="row g-3 mb-3">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="T-Bone Steak">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">T-Bone Steak</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$16.50</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Chef's Salmon">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Chef's Salmon</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$12.40</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Ramen">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Ramen</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$14.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Chicken Breast">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Chicken Breast</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$15.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="T-Bone Steak">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">T-Bone Steak</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$16.50</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Chef's Salmon">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Chef's Salmon</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$12.40</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Ramen">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Ramen</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$14.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Chicken Breast">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Chicken Breast</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="text-success fw-bold">$15.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Order -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between">
                                    <span>Current Order</span>
                                    <button class="btn btn-sm btn-outline-danger">Clear All</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>T-Bone Steak</strong>
                                            <span class="badge bg-secondary">x2</span>
                                        </div>
                                        <span>$66.00</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Soup of the Day</strong>
                                            <span class="badge bg-secondary">x1</span>
                                        </div>
                                        <span>$7.50</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Pancakes</strong>
                                            <span class="badge bg-secondary">x2</span>
                                        </div>
                                        <span>$27.00</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal:</span>
                                    <span>$100.50</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Discounts:</span>
                                    <span>-$8.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Tax (12%):</span>
                                    <span>$11.20</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold mt-2">
                                    <span>Total:</span>
                                    <span class="text-success">$93.46</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-around mb-3">
                                    <button class="btn btn-outline-secondary">Cash</button>
                                    <button class="btn btn-outline-primary">Card</button>
                                    <button class="btn btn-outline-secondary">E-Wallet</button>
                                </div>
                                <button class="btn btn-primary w-100">Print Bills</button>
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
@endsection
