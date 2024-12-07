<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Produk;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['productsOutOfStock'] = Produk::where('stok', 0)->get();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $data['transaksiBulanIni'] = Transaksi::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->count();

        $data['penjualanNow'] = Transaksi::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('total_pembayaran');

        $previousMonth = Carbon::now()->subMonth()->month;
        $previousYear = Carbon::now()->subMonth()->year;

        $transaksiBulanLalu = Transaksi::whereYear('tanggal', $previousYear)
            ->whereMonth('tanggal', $previousMonth)
            ->count();

        if ($transaksiBulanLalu > 0) {
            $percentageChange = (($data['transaksiBulanIni'] - $transaksiBulanLalu) / $transaksiBulanLalu) * 100;
        } else {
            $percentageChange = $data['transaksiBulanIni'] > 0 ? 100 : 0;
        }

        $data['percentageChange'] = $percentageChange;

        $penjualanThen = Transaksi::whereYear('tanggal', $previousYear)
            ->whereMonth('tanggal', $previousMonth)
            ->sum('total_pembayaran');

        if ($penjualanThen > 0) {
            $percentageChangePenjualan = (($data['penjualanNow'] - $penjualanThen) / $penjualanThen) * 100;
        } else {
            $percentageChangePenjualan = $data['penjualanNow'] > 0 ? 100 : 0;
        }

        $data['percentageChangePenjualan'] = $percentageChangePenjualan;

        // Mengambil total transaksi untuk 12 bulan terakhir
        $data['transaksiPerBulan'] = [];
        $now = Carbon::now();

        for ($i = 0; $i < 12; $i++) {
            $month = $now->copy()->subMonths($i);
            $data['transaksiPerBulan'][$month->format('M Y')] = Transaksi::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('total_pembayaran');
        }

        $data['transaksiPerBulan'] = array_reverse($data['transaksiPerBulan'], true);

        return view('pages.dashboard', $data);
    }
}
