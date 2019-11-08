<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefPelanggan;

class RefPelangganController extends Controller
{
    public function Index() {
        $model = RefPelanggan::all();
    	return view('ref-pelanggan/index', ['model' => $model]);
    }

    public function Tambah() {
    	return view('ref-pelanggan/tambah');
    }

    public function Create(Request $request) {
    	$this->validate($request,[
           'nama' => 'required|max:100',
           'alamat' => 'required|max:255',
           'no_hp' => 'required|max:13'
        ]);

        $model = RefPelanggan::create([
    		'nama' => $request->nama,
    		'alamat' => $request->alamat,
    		'no_hp' => $request->no_hp,
    	]);

    	return redirect('ref-pelanggan/index');
    }

    public function Ubah($id) {
    	$model = RefPelanggan::find($id);

    	return view('ref-pelanggan/ubah', ['model' => $model]);
    }

    public function Update($id, Request $request) {
    	$model = RefPelanggan::find($id);
        $model->nama = $request->nama;
        $model->alamat = $request->alamat;
        $model->no_hp = $request->no_hp;
        $model->save();

        return redirect('ref-pelanggan/index');
    }

    public function Hapus($id) {
    	$model = RefPelanggan::find($id);
        $model->delete();
        
        return redirect('ref-pelanggan/index');
    }
}
