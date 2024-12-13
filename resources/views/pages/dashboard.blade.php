@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Transaksi Bulan ini</p>
                                <h5 class="font-weight-bolder">
                                    {{ number_format($transaksiBulanIni) }}
                                </h5>
                                <p class="mb-0">
                                    @if($percentageChange < 0)
                                        <span class="text-danger text-sm font-weight-bolder">{{ number_format($percentageChange, 2) }}%</span>
                                        @else
                                        <span class="text-success text-sm font-weight-bolder">+{{ number_format($percentageChange, 2) }}%</span>
                                        @endif
                                        sejak bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Penjualan Bulan Ini</p>
                                <h5 class="font-weight-bolder">
                                    Rp. {{ number_format($penjualanNow) }}
                                </h5>
                                <p class="mb-0">
                                    @if($percentageChangePenjualan < 0)
                                        <span class="text-danger text-sm font-weight-bolder">{{ number_format($percentageChangePenjualan, 2) }}%</span>
                                        @else
                                        <span class="text-success text-sm font-weight-bolder">+{{ number_format($percentageChangePenjualan, 2) }}%</span>
                                        @endif
                                        sejak bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Klien Baru</p>
                                <h5 class="font-weight-bolder">
                                    +3,462
                                </h5>
                                <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    sejak kuartal terakhir
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Penjualan</p>
                                <h5 class="font-weight-bolder">
                                    $103,430
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span> sejak bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Penjualan 12 Bulan Terakhir</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Stok Kosong</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            @forelse ($productsOutOfStock as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            @if ($item->foto)
                                            <img src="{{ \Storage::url($item->foto) }}" class="avatar avatar-sm me-3" alt="user1">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->nama_produk }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($item->harga, 2) }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-danger">{{ number_format($item->stok) }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                        Ubah
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
                                                <div class="mb-3" style="display: none;">
                                                    <label for="namaProduk{{ $item->id }}" class="form-label">Nama Produk</label>
                                                    <input type="text" class="form-control" id="namaProduk{{ $item->id }}" name="nama_produk" value="{{ $item->nama_produk }}" required>
                                                </div>
                                                <div class="mb-3" style="display: none;">
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
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Tidak ada produk kosong</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Produk Penjualan Terbanyak Hari Ini</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        @foreach($produkTerlarisHariIni as $produk)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    @if ($produk->foto)
                                    <img src="{{ \Storage::url($produk->foto) }}" class="avatar avatar-sm me-3" alt="user1">
                                    @endif
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">{{ $produk->nama_produk }}</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <span class="text-sm font-weight-bold">{{ $produk->total_terjual }} terjual</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection

@push('js')
<script src="./assets/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: <?php echo json_encode(array_keys($transaksiPerBulan)); ?>,
            datasets: [{
                label: "Total Transaksi",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#fb6340",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: <?php echo json_encode(array_values($transaksiPerBulan)); ?>,
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
@endpush