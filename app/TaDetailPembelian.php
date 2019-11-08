<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaDetailPembelian extends Model
{
    protected $table = "ta_detail_pembelian";

    protected $fillable = ['no_pembelian', 'barang_id', 'qty', 'harga', 'sub_total'];
}
