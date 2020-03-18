<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefKategori;
use Datatables;

class RefKategoriController extends Controller
{
    public function Index() {
        $model = RefKategori::all();
    	return view('ref-kategori/index', ['model' => $model]);
    }

    public function GetKategori() {
        $model = RefKategori::all();

    	return Datatables::of($model)
        ->addColumn('action', function($model) {
            return 
            '<a href ="ref-kategori/ubah/'.$model->id.'" class="btn btn-small btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> </a>'.
            '<a href ="ref-kategori/hapus/'.$model->id.'" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> </a>';
        })
        ->toJson();
    }

    public function Tambah() {
    	return view('ref-kategori/tambah');
    }

    public function Create(Request $request) {
    	$model = RefKategori::create([
    		'kategori' => $request->kategori,
    	]);

    	return redirect('ref-kategori/tambah')->with(['success' => 'Data berhasi disimpan']);
    }

    public function Ubah($id) {
    	$model = RefKategori::find($id);

    	return view('ref-kategori/ubah', ['model' => $model]);
    }

    public function Update($id, Request $request) {
        $model = RefKategori::find($id);
        $model->kategori = $request->kategori;
        $model->save();

        return redirect('ref-kategori/index')->with(['success' => 'Data berhasi diubah']);
    }

    public function Hapus($id) {
        $model = RefKategori::find($id);
        $model->delete();
        
        return redirect('ref-kategori/index');
    }
}
