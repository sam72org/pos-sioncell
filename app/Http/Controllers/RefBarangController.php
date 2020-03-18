<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefBarang;
use App\RefKategori;
use Datatables;

class RefBarangController extends Controller
{
    public function Index() {
        $model = RefBarang::orderBy('nama_barang', 'ASC')->get();
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

        $cek_barcode = RefBarang::where('kode_barcode', $request->kode_barcode)->first();
        if (isset($cek_barcode)) {
            return 1;
        }
        else {
            $model = new RefBarang;
            $model->kode_barcode    = $request->kode_barcode;
            $model->nama_barang     = $request->nama_barang;
            $model->kategori_id     = $request->kategori;
            $model->harga_beli      = $request->harga_beli;
            $model->harga_jual      = $request->harga_jual;
            $model->harga_nego      = $request->harga_nego;
            $model->stok            = $request->stok;
            $model->save();
        }        

        // $this->validate($request, [
        //     'kode_barcode' => 'required|max:20',
        //     'nama_barang' => 'required',
        //     'stok' => 'required|numeric',
        //     'harga_beli' => 'required|numeric',
        //     'harga_jual' => 'required|numeric',
        //     'harga_nego' => 'required|numeric',
        //     'kategori' => 'required',
        // ]);

    	// $model = RefBarang::create([
     //        'kode_barcode' => $request->kode_barcode,
    	// 	'nama_barang' => $request->nama_barang,
     //        'kategori_id' => $request->kategori,
     //        'harga_beli' => $request->harga_beli,
     //        'harga_jual' => $request->harga_jual,
     //        'harga_nego' => $request->harga_nego,
     //        'stok' => $request->stok,
    	// ]);

    	// return redirect('ref-barang/tambah')->with(['success' => 'Data berhasil ditambah']);
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
        $model->kode_barcode = $request->kode_barcode;
        $model->nama_barang = $request->nama_barang;
        $model->harga_beli = $request->harga_beli;
        $model->harga_jual = $request->harga_jual;
        $model->harga_nego = $request->harga_nego;
        $model->stok = $request->stok;
        $model->kategori_id = $request->kategori;
        $model->save();

        return redirect('ref-barang/index')->with(['success' => 'Data berhasil diubah']);
    }

    public function Hapus($id) {
        $model = RefBarang::find($id);
        $model->delete();
        
        return redirect('ref-barang/index');
    }
}
