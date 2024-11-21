<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    /** @use HasFactory<\Database\Factories\DetailTransaksiFactory> */
    use HasFactory;
    protected $guarded =[];

    public function transaksi():BelongsTo{
        return $this->belongsTo(Transaksi::class);
    }
    public function produk():BelongsTo{
        return $this->belongsTo(Produk::class);
    }
}
