<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaPenjualan extends Model
{
    protected $table = "ta_penjualan";

    protected $fillable = ["no_penjualan", "pelanggan_id", "user_id", "grand_total", 'tgl_penjualan', 'tgl_jatuh_tempo', 'status_pembayaran'];

    public function pelanggan() {
    	return $this->belongsTo('App\RefPelanggan');
    }

    public function detailpenjualan() {
    	return $this->hasMany('App\TaDetailPenjualan');
    }
}
