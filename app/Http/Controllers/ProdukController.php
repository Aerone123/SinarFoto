<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Http\Request;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->filled('search_produk')){
            $data['produk'] = Produk::search(request('search_produk'))->paginate(10);
        }else{
            $data['produk'] = Produk::latest()->paginate(10);
        }
        return view('product',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok'=>'required|numeric',
            'foto'=>'nullable|image:jpeg,jpg,png',
        ]);

        $produk = new \App\Models\Produk();
        $produk->fill($requestData);
        $produk->foto=$request->file('foto')->store('public');
        $produk->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }

}
