<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefDistributor;
use Datatables;

class RefDistributorController extends Controller
{
    public function Index() {
        $model = RefDistributor::all();
    	return view('ref-distributor/index', ['model' => $model]);
    }

    public function GetMeja() {
        $model = RefDistributor::all();

    	return Datatables::of($model)
        ->addColumn('action', function($model) {
            return 
            '<a href ="ref-distributor/ubah/'.$model->id.'" class="btn btn-small btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> </a>'.
            '<a href ="ref-distributor/hapus/'.$model->id.'" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> </a>';
        })
        ->toJson();
    }

    public function Tambah() {
    	return view('ref-distributor/tambah');
    }

    public function Create(Request $request) {
        $this->validate($request,[
           'nama' => 'required|max:100',
           'alamat' => 'required|max:255',
           'no_hp' => 'required|max:13'
        ]);

    	$model = RefDistributor::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
    		'no_hp' => $request->no_hp,
    	]);

    	return redirect('/ref-distributor/tambah')->with(['success' => 'Data berhasil disimpan.']);
    }

    public function Ubah($id) {
    	$model = RefDistributor::find($id);

    	return view('ref-distributor/ubah', ['model' => $model]);
    }

    public function Update($id, Request $request) {
        $model = RefDistributor::find($id);
        $model->nama = $request->nama;
        $model->alamat = $request->alamat;
        $model->no_hp = $request->no_hp;
        $model->save();

        return redirect('/ref-distributor/index')->with(['success' => 'Data berhasil diubah.']);
    }

    public function Hapus($id) {
        $model = RefDistributor::find($id);
        $model->delete();
        
        return redirect('/ref-distributor/index');
    }
}
