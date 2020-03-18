<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefBarang extends Model
{
    protected $table = "ref_barang";
    protected $fillable = ['nama_barang', 'kode_barcode', 'kategori_id', 'harga_beli', 'harga_jual', 'harga_nego', 'stok'];

    public function kategori() {
    	return $this->belongsTo('App\RefKategori');
    }

    public function detailpenjualan() {
    	return $this->hasMany('App\TaDetailPenjualan');
    }

    public function historybarang() {
    	return $this->hasMany('App\TaHistoryBarang');
    }
}
