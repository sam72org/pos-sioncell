<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaPembelian;
use App\RefDistributor;
use App\RefBarang;
use App\TaDetailPembelian;
use App\TaHistoryBarang;
use Datatables;
use Illuminate\Support\Facades\DB;
use Session;

class TaPembelianController extends Controller
{
    public function Index() {
        // $model = TaPembelian::orderBy('id', 'DESC')->get();
        $model = TaPembelian::all();
    	return view('ta-pembelian/index', ['model' => $model]);
    }

    public function NewTransaction(Request $request) {
        // $request->session()->flush();

        if($request->session()->has('orders')) {
            $session_order =  $request->session()->get('orders');
            // print_r($session_order);die();
        }
        else {
            $session_order = session('orders');
        }

        $distributors = RefDistributor::all();

        return view('ta-pembelian/form', ['session_order' => $session_order, 'distributors' => $distributors]);
    }

    public function addList(Request $request) {
    
        if ($request->session()->has('orders')) {
            $session_order =  $request->session()->get('orders');
        }

        $session_order = $request->session()->push('orders', [
            'id' => $request->id, 
            'qty' => $request->qty,
            'harga' => $request->harga,
        ]);
    }

    public function deleteList(Request $request) {
        $item = $request->id;

        foreach ($request->session()->get('orders', []) as $id => $entries) {
            if ($entries['id'] === $item) {
                $request->session()->forget('orders.' . $id);
                break; // stop loop
            }
        }

        $session_order =  $request->session()->get('orders');
    }

    public function SaveTransaction(Request $request) {
        $session_order = $request->session()->get('orders');

        $kode = DB::table('ta_pembelian')
                ->select('no_pembelian')
                ->orderByRaw('no_pembelian DESC')
                ->get();

        if (!isset($kode[0])) {
            $last_kode = "PB-00000000";
        }
        else {
            $last_kode = $kode[0]->no_pembelian;
        }
        
        $kodePB = substr($last_kode, 3, 8);
        $kodePB++;
        $no_pembelian = 'PB-' . sprintf('%08s', $kodePB);

        $model = new TaPembelian;
        $model->no_pembelian = $no_pembelian;
        $model->distributor_id = $request->distributor_id;
        $model->grand_total = $request->total;
        $model->tanggal = date('Y-m-d');
        $model->user_id = auth()->user()->id;

        if ($model->save()) {
            foreach ($session_order as $key => $value) {
                $model2 = new TaDetailPembelian;
                $model2->no_pembelian = $no_pembelian;
                $model2->barang_id = $value['id'];
                $model2->qty = $value['qty'];
                $model2->harga = $value['harga'];
                $model2->sub_total = $value['harga'] * $value['qty'];

                if ($model2->save()) {
                    $stok = RefBarang::where('id', $value['id'])->first();
                    $stok->stok += $model2->qty;
                    $stok->save();
                }
            }
            
            $request->session()->forget('orders');
        }
    }

    public function ViewTransaction(Request $request, $no_pembelian) {
        $model1 = TaPembelian::where('no_pembelian', $no_pembelian)->first();
        $model2 = TaDetailPembelian::where('no_pembelian', $no_pembelian)->get();
        return view('ta-pembelian/view', ['model1' => $model1, 'model2' => $model2]);
    }
}
