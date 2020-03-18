<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaJasa;

class TaJasaController extends Controller
{
    public function Index() {
    	$model	= TaJasa::orderBy('id', 'DESC')->get();
	   	$user   = auth()->user();

	    return view('ta-jasa/index', ['model' => $model, 'user' => $user]);
    }

     public function Tambah() {
    	return view('ta-jasa/tambah');
    }

    public function Create(Request $request) {
        $this->validate($request,[
           'no_hp' => 'numeric',   
        ]);

    	$model = TaJasa::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'teknisi' => $request->teknisi,
            'ket' => $request->ket,
            'harga' => $request->harga,
            'user_id' => auth()->user()->id,
    	]);

        return redirect('ta-jasa/tambah')->with(['success' => 'Data sukses disimpan.']);
    }

    public function Ubah($id) {
        $model = TaJasa::find($id);

        return view('ta-jasa/ubah', ['model' => $model]);
    }

    public function Update($id, Request $request) {
        $model = TaJasa::find($id);
        $model->nama = $request->nama;
        $model->no_hp = $request->no_hp;
        $model->ket = $request->ket;
        $model->teknisi = $request->teknisi;
        $model->harga = $request->harga;
        $model->save();

        return redirect('ta-jasa/index')->with(['success' => 'Data sukses diubah']);
    }
}
