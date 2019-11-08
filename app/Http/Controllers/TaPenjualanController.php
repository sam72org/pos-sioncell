<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaPenjualan;
use App\RefPelanggan;
use App\RefBarang;
use App\TaDetailPenjualan;
use App\TaHistoryBarang;
use Datatables;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;

class TaPenjualanController extends Controller
{
    public function Index() {
        // $model = TaPenjualan::orderBy('id', 'DESC')->get();
        $model = TaPenjualan::all();
    	return view('ta-penjualan/index', ['model' => $model]);
    }

    public function GetPenjualan() {
        $model = TaPenjualan::all();

    	return Datatables::of($model)
        ->addColumn('action', function($data) {
            return 
            '<a href ="ta-penjualan/view/'.$data->id.'" class="btn btn-small btn-warning" style="margin-right:5px;"><i class="fa fa-eye"></i> </a>'.
            '<a href ="ta-penjualan/print/'.$data->id.'" class="btn btn-small btn-primary"><i class="fa fa-print"></i> </a>';
        })
        ->toJson();
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

        $kode = DB::table('ta_penjualan')
        		->select('no_penjualan')
        		->orderByRaw('no_penjualan DESC')
        		->get();

        if (!isset($kode[0])) {
            $last_kode = "SC-000000";
        }
        else {
            $last_kode = $kode[0]->no_penjualan;
        }
        
        $kodePJ = substr($last_kode, 3, 6);
        $kodePJ++;
        $no_penjualan = 'SC-' . sprintf('%06s', $kodePJ);

        $members = RefPelanggan::all();

        return view('ta-penjualan/form', ['no_penjualan' => $no_penjualan, 'session_order' => $session_order, 'members' => $members]);
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

    public function getMenu() {
        $model = RefMenu::all();

        return Datatables::of($model)
        ->addColumn('action', function($model) {
            return
            '<button class="btn btn-small btn-success btn-pilih" data-id="'.$model->id.'" data-kode="'.$model->kode.'" data-menu="'.$model->menu.'" data-harga="'.$model->harga.'"><i class="fa  fa-check-square-o"></i></button>';
        })
        ->make(true);
    }

    public function SaveTransaction(Request $request) {
        $session_order = $request->session()->get('orders');

        $model = new TaPenjualan;
        $model->no_penjualan        = $request->no_penjualan;
        $model->user_id             = 1;
        $model->pelanggan_id        = $request->pelanggan_id;
        $model->grand_total         = $request->total;
        $model->status_pembayaran   = 0;
        $model->tgl_penjualan       = date('Y-m-d', strtotime($request->tgl_penjualan));
        $model->tgl_jatuh_tempo     = date('Y-m-d', strtotime($request->tgl_jatuh_tempo));

        if ($model->save()) {
            foreach ($session_order as $key => $value) {

                $model2 = new TaDetailPenjualan;
                $model2->no_penjualan = $request->no_penjualan;
                $model2->barang_id = $value['id'];
                $model2->qty = $value['qty'];
                $model2->harga = $value['harga'];
                $model2->sub_total = $value['harga'] * $value['qty'];

                if ($model2->save()) {
                    $model3 = new TaHistoryBarang;
                    $model3->no_transaksi = $request->no_penjualan;
                    $model3->barang_id = $value['id'];
                    $model3->qty = $value['qty'];
                    $model3->tipe = "Keluar";
                    $model3->keterangan = "Penjualan Barang";
                    $model3->tanggal = date('Y-m-d', strtotime($request->tgl_penjualan));
                    $model3->user_id = 1;

                    if ($model3->save()) {
                        $stok = RefBarang::where('id', $value['id'])->first();
                        $stok->stok -= $model2->qty;
                    
                        if ($stok->save()) {
                            $stok = RefBarang::where('id', $value['id'])->first();
                            $history = TaHistoryBarang::where('barang_id', $value['id'])
                                        ->where('no_transaksi', $request->no_penjualan)
                                        ->first();
                            $history->stok = $stok->stok;
                            $history->save();
                        }
                    }     
                }
            }

            $request->session()->forget('orders');
            // $request->session()->flush();
        }
    }

    public function KonfirmasiPembayaran(Request $request, $id) {
        $model = TaPenjualan::where('id', $id)->first();
        $model->status_pembayaran = 1;
        $model->save();

        return redirect('ta-penjualan/index');
    }

    public function ViewTransaction(Request $request, $no_penjualan) {
        $model1 = TaPenjualan::where('no_penjualan', $no_penjualan)->first();
        $model2 = TaDetailPenjualan::where('no_penjualan', $no_penjualan)->get();
        return view('ta-penjualan.view', ['model1' => $model1, 'model2' => $model2]);
    }

    public function PrintTransaction(Request $request, $no_penjualan) {

        $model = TaDetailPenjualan::where('no_penjualan', $no_penjualan)->get();

        $pdf = PDF::loadview('ta-penjualan/print-struk', [
            'model' => $model, 
            'no_penjualan' => $no_penjualan,
        // ])->setPaper('a4', 'landscape');
        ])->setPaper([0, 0, 612, 396]);

        return $pdf->stream();
    }
}
