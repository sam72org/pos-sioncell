<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaPenjualan extends Model
{
    protected $table = "ta_penjualan";
    protected $fillable = ["no_penjualan", "pelanggan_id", "user_id", "grand_total"];

    public function pelanggan() {
    	return $this->belongsTo('App\RefPelanggan');
    }

    public function barang() {
        return $this->belongsTo('App\RefBarang');
    }

    public function detailpenjualans() {
    	return $this->hasMany('App\TaDetailPenjualan');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
