<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaPulsa extends Model
{
    protected $table = "ta_pulsa";
    protected $fillable = ["kategori", "operator", "nominal", "no_hp", "harga", "user_id"];

    public function kategoripulsa() {
    	return $this->belongsTo('App\RefKategoriPulsa');
    }
}
