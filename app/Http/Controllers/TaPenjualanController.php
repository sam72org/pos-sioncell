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
        $model  = TaPenjualan::orderBy('id', 'DESC')->get();
        $user   = auth()->user();
    	return view('ta-penjualan/index', ['model' => $model, 'user' => $user]);
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
        // $request->session()->forget('orders');

        if($request->session()->has('orders')) {
            $session_order =  $request->session()->get('orders');
        }
        else {
            $session_order = session('orders');
        }

        $kode = DB::table('ta_penjualan')
        		->select('no_penjualan')
        		->orderByRaw('no_penjualan DESC')
        		->get();

        if (!isset($kode[0])) {
            $last_kode = "PJ-00000000";
        }
        else {
            $last_kode = $kode[0]->no_penjualan;
        }
        
        $kodePJ = substr($last_kode, 3, 8);
        $kodePJ++;
        $no_penjualan = 'PJ-' . sprintf('%08s', $kodePJ);

        return view('ta-penjualan/form', ['no_penjualan' => $no_penjualan, 'session_order' => $session_order]);
    }

    public function addList(Request $request) {
        $item   = RefBarang::where('kode_barcode', $request->barcode)->first();
        $orders = $request->session()->get('orders', []);

        // Check session sudah ada/tidak //
        if ($request->session()->has('orders')) {
            $orders = $request->session()->get('orders', []);

            // Cek data dalam sesssion, jika tidak ada tambah data dalam session, jika sudah ada tambah jumlah quantity //
            if (!in_array($item->id, array_column($orders, 'id'))) {
                $request->session()->push('orders', ['id' => $item->id, 'qty' => 1, 'harga' => $item->harga_jual]);
            }
            else {
                // foreach ($orders as $key => $order) {
                //     if ($order['id'] == $item->id) {
                //         $order['qty']++;
                //         break;
                //     }
                // }
                // $request->session()->put('orders.' . $key, $order);
                foreach ($orders as $key => $order) {
                    if ($order['id'] == $item->id) {
                        $stok = $item->stok - $order['qty'];
                        if ($stok > 0) {
                            $order['qty']++;
                            break;
                        } 
                        else {
                            return 0;
                        }
                    }
                }
                $request->session()->put('orders.' . $key, $order);
            }
        }
        else {
            $request->session()->push('orders', ['id' => $item->id, 'qty' => 1, 'harga' => $item->harga_jual]);
        }
    }

    public function tambahQtyList(Request $request) {
        $id     = $request->id;
        $item   = RefBarang::where('id', $id)->first();
        $orders = $request->session()->get('orders', []);

        foreach ($orders as $key => $order) {
            if ($order['id'] == $id) {
                $stok = $item->stok - $order['qty'];
                if ($stok > 0) {
                    $order['qty']++;
                    break;
                } 
                else {
                    return 0;
                }
            }
        }
        $request->session()->put('orders.' . $key, $order);
    }

    public function kurangQtyList(Request $request) {
        $id     = $request->id;
        $orders = $request->session()->get('orders', []);
        $q      = count($orders);

        foreach ($orders as $key => $order) {
            if ($order['id'] == $id) {
                $order['qty']--;
                break; // stop loop
            }
        }

        if ($order['qty'] == 0 AND $q > 1) {
            $request->session()->forget('orders.' . $key);
        }
        else if ($order['qty'] == 0 AND $q == 1) {
            $request->session()->forget('orders');
        }
        else {
            $request->session()->put('orders.' . $key, $order);
        }
    }

    public function deleteList(Request $request) {
        $id     = $request->id;
        $orders = $request->session()->get('orders', []);
        $q      = count($orders);
        
        foreach ($orders as $key => $order) {
            if ($order['id'] == $id AND $q > 1) {
                $request->session()->forget('orders.' . $key);
                break;
            }
            else if ($order['id'] AND $q == 1) {
                $request->session()->forget('orders');
                break;
            }
        }
    }

    public function changePriceList(Request $request) {
        $id     = $request->id;
        $harga  = $request->harga_jual;
        $orders = $request->session()->get('orders', []);
        
        foreach ($orders as $key => $order) {
            if ($order['id'] == $id) {
                $order['harga'] = $harga;
                break;
            }
        }
        $request->session()->put('orders.' . $key, $order);
    }

    public function GetBarang(Request $request) {
        $kode_barcode = $request->kode_barcode;
        $model = RefBarang::where('kode_barcode', $kode_barcode)->first();
        return $model;
    }

    public function SaveTransaction(Request $request) {
        $session_order = $request->session()->get('orders');
        $user          = auth()->user();

        $model = new TaPenjualan;
        $model->no_penjualan        = $request->no_penjualan;
        $model->user_id             = $user->id;
        $model->pelanggan_id        = 0;
        $model->grand_total         = $request->total;
        $model->status_pembayaran   = 0;

        if ($model->save()) {

            foreach ($session_order as $key => $value) {

                $model2 = new TaDetailPenjualan;
                $model2->ta_penjualan_id = $model->id;
                $model2->no_penjualan = $request->no_penjualan;
                $model2->barang_id = $value['id'];
                $model2->qty = $value['qty'];
                $model2->harga = $value['harga'];
                $model2->sub_total = $value['harga'] * $value['qty'];

                if ($model2->save()) {
                    $stok = RefBarang::where('id', $value['id'])->first();
                    $stok->stok -= $model2->qty;
                    $stok->save();
                }
            }

            $request->session()->forget('orders');
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
        // ])->setPaper('a4', 'portrait');
        ])->setPaper([0, 0, 396, 512]);
        // ])->setPaper([0, 0, 612, 396]);

        return $pdf->stream();
    }

    public function ListItemSold() {
        $model  = TaDetailPenjualan::orderBy('id', 'ASC')->get();
        return view('ta-penjualan/list-item-sold', ['model' => $model]);
    }
}
