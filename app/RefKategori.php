<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefKategori extends Model
{
    protected $table = "ref_kategori";

    protected $fillable = ['kategori'];

    public function menu() {
    	return $this->hasOne('App\RefMenu');
    }
}
