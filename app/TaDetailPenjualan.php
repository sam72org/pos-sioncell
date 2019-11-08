<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaDetailPenjualan extends Model
{
    protected $table = "ta_detail_penjualan";

    protected $fillable = ['no_penjualan', 'barang_id', 'qty', 'harga', 'sub_total'];

    public function penjualan() {
    	return $this->belongsTo('App\TaPenjualan');
    }

    public function barang() {
    	return $this->belongsTo('App\RefBarang');
    }
}
