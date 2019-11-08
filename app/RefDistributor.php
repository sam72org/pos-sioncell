<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefDistributor extends Model
{
    protected $table = "ref_distributor";

    protected $fillable = ['nama', 'alamat', 'no_hp'];

    public function penjualan() {
    	return $this->hasMany('App\TaPembelian');
    }
}
