<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefMeja extends Model
{
   	protected $table = "ref_meja";

   	protected $fillable = ['meja'];

    public function penjualan() {
    	return $this->hasMany('App\TaPenjualan');
    }
}
