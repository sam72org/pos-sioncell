<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaPulsa;
use App\RefOperatorPulsa;
use Illuminate\Support\Facades\DB;

class TaPulsaController extends Controller
{
    public function Index() {
    	$model  = TaPulsa::orderBy('id', 'DESC')->get();
        $user   = auth()->user();

    	return view('ta-pulsa/index', ['model' => $model, 'user' => $user]);
    }

    public function Tambah() {
    	return view('ta-pulsa/tambah');
    }

    public function Create(Request $request) {
        $this->validate($request,[
           'no_hp' => 'numeric',   
        ]);

    	$model = TaPulsa::create([
            'kategori' => $request->kategori,
            'operator' => $request->operator,
            'nominal' => $request->nominal,
            'no_hp' => $request->no_hp,
            'harga' => $request->harga,
            'user_id' => auth()->user()->id,
    	]);

        return redirect('ta-pulsa/tambah')->with(['success' => 'Data sukses disimpan.']);
    }

    public function Ubah($id) {
        $model = TaPulsa::find($id);

        return view('ta-pulsa/ubah', ['model' => $model]);
    }

    public function Update($id, Request $request) {
        $model = TaPulsa::find($id);
        $model->kategori = $request->kategori;
        $model->operator = $request->operator;
        $model->nominal = $request->nominal;
        $model->no_hp = $request->no_hp;
        $model->harga = $request->harga;
        $model->save();

        return redirect('ta-pulsa/index')->with(['success' => 'Data sukses diubah']);
    }
}
