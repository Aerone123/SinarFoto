<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

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
        $currentDay = Carbon::now()->day;
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;


        $data['penjualanHariIni'] = Transaksi::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->whereDay('tanggal', $currentDay)
            ->sum('total_pembayaran');

        $yesterday = now()->subDay();
        $penjualanKemarin = Transaksi::whereDate('tanggal', $yesterday->toDateString())->sum('total_pembayaran');

        if ($penjualanKemarin > 0) {
            $percentageChangeSumYesterday = (($data['penjualanHariIni'] - $penjualanKemarin) / $penjualanKemarin) * 100;
        } else {
            $percentageChangeSumYesterday = $data['penjualanHariIni'] > 0 ? 100 : 0;
        }
        $data['percentageChangeSumYesterday'] = $percentageChangeSumYesterday;


        $data['transaksiHariIni'] = Transaksi::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->whereDay('tanggal', $currentDay)
            ->count();

        $yesterday = now()->subDay();
        $transaksiKemarin = Transaksi::whereDate('tanggal', $yesterday->toDateString())->count();

        if ($transaksiKemarin > 0) {
            $percentageChangeYesterday = (($data['transaksiHariIni'] - $transaksiKemarin) / $transaksiKemarin) * 100;
        } else {
            $percentageChangeYesterday = $data['transaksiHariIni'] > 0 ? 100 : 0;
        }
        $data['percentageChangeYesterday'] = $percentageChangeYesterday;

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

        $data['transaksiPerBulan'] = [];
        $now = Carbon::now();

        for ($i = 0; $i < 12; $i++) {
            $month = $now->copy()->subMonths($i);
            $data['transaksiPerBulan'][$month->format('M Y')] = Transaksi::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('total_pembayaran');
        }

        $data['transaksiPerBulan'] = array_reverse($data['transaksiPerBulan'], true);

        // Get the top-selling products today
        $today = Carbon::today();
        $data['produkTerlarisHariIni'] = Produk::select('produks.nama_produk', 'produks.stok', 'produks.foto', DB::raw('SUM(detail_transaksis.jumlah) as total_terjual'))
            ->join('detail_transaksis', 'produks.id', '=', 'detail_transaksis.produk_id')
            ->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->whereDate('transaksis.tanggal', $today)
            ->groupBy('produks.id', 'produks.nama_produk', 'produks.stok')
            ->orderBy('total_terjual', 'DESC')
            ->take(5)
            ->get();



        return view('pages.dashboard', $data);
    }
}
