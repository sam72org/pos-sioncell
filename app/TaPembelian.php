<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaPembelian extends Model
{
    protected $table = "ta_pembelian";

    protected $fillable = ["no_pembelian", "distributor_id", "grand_total", "tanggal", "user_id"];

    public function distributor() {
    	return $this->belongsTo('App\RefDistributor');
    }
}
