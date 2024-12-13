<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('search_produk')) {
            $data['produk'] = Produk::search(request('search_produk'))->get();
        } else {
            $data['produk'] = Produk::get();
        }
        $data['transaksi'] = Transaksi::latest()->paginate(10);
        return view('transaksi')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check stock availability before starting the transaction
        foreach ($request->items as $item) {
            $produk = Produk::find($item['produk_id']);
            if ($produk->stok < $item['jumlah']) {
                return response()->json(['success' => false, 'error' => 'Stok produk tidak mencukupi untuk ' . $produk->nama_produk]);
            }
        }

        DB::beginTransaction();

        try {
            // Create new transaksi record
            $transaksi = Transaksi::create([
                'tanggal' => $request->tanggal,
                'total_pembayaran' => $request->total_pembayaran,
                'diskon' => $request->diskon
            ]);

            // Insert each product into detail_transaksis table
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);

                // Deduct stock after confirming availability
                $produk->stok -= $item['jumlah'];
                $produk->save();

                DetailTransaksi::create([
                    'produk_id' => $item['produk_id'],
                    'transaksi_id' => $transaksi->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal']
                ]);
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
