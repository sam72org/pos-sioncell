<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefBarang;
use App\RefKategori;
use Datatables;

class RefBarangController extends Controller
{
    public function Index() {
        $model = RefBarang::all();
    	return view('ref-barang/index', ['model' => $model]);
    }

    public function GetMenu() {
        $model = RefBarang::all();

    	return Datatables::of($model)
        ->addColumn('action', function($model) {
            return 
            '<a href ="ref-barang/ubah/'.$model->id.'" class="btn btn-small btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> </a>'.
            '<a href ="ref-barang/hapus/'.$model->id.'" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> </a>';
        })
        ->toJson();
    }

    public function Tambah() {
        $kategori = RefKategori::all();
    	return view('ref-barang/tambah', ['kategori' => $kategori]);
    }

    public function Create(Request $request) {
        $this->validate($request, [
            'nama_barang' => 'required',
            'stok' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'kategori' => 'required',
        ]);

    	$model = RefBarang::create([
    		'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga_beli' => $request->harga_beli,
    		'kategori_id' => $request->kategori,
    	]);

    	return redirect('ref-barang/index');
    }

    public function Ubah($id) {
    	$model = RefBarang::find($id);

        $kategori = RefKategori::all();
        $selectedKategori = RefBarang::where('id', $id)->first()->kategori_id;

    	return view('ref-barang/ubah', [
            'model' => $model, 
            'kategori' => $kategori, 
            'selectedKategori' => $selectedKategori,
        ]);
    }

    public function Update($id, Request $request) {
        $model = RefBarang::find($id);
        $model->nama_barang = $request->nama_barang;
        $model->harga_beli = $request->harga_beli;
        $model->stok = $request->stok;
        $model->kategori_id = $request->kategori;
        $model->save();

        return redirect('ref-barang/index');
    }

    public function Hapus($id) {
        $model = RefBarang::find($id);
        $model->delete();
        
        return redirect('ref-barang/index');
    }
}
