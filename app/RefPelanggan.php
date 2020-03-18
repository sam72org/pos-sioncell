<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefPelanggan extends Model
{
    protected $table = "ref_pelanggan";
    protected $fillable = ["nama", "alamat", "no_hp"];
}
