<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaHistoryBarang extends Model
{
    protected $table = "ta_history_barang";

    protected $fillable = ['no_transaksi', 'barang_id', 'qty', 'tipe', 'keterangan', 'tanggal', 'user_id'];

    public function barang() {
    	return $this->belongsTo('App\RefBarang');
    }
}
