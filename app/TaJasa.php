<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaJasa extends Model
{
    protected $table = "ta_jasa";
    protected $fillable = ["nama", "no_hp", "teknisi", "ket", "harga", "user_id"];
}
