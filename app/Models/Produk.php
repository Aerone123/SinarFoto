<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use SearchableTrait;
    use HasFactory;
    protected $guarded =[];
    protected $searchable = [
        'columns' => [
            'produks.nama_produk' => 10,  
        ],
    ];


    public function detailtransaksi():HasMany{
        return $this->hasMany(DetailTransaksi::class);
    }
}
