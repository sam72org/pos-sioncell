<?php

namespace App\Http\Controllers;
use App\TaHistoryBarang;
use App\TaPenjualan;
use App\TaPembelian;
use PDF;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function HistoryStok() {
    	$model = TaHistoryBarang::all();
    	return view('laporan/history-stok', ['model' => $model]);
    }

    public function LaporanPenjualan() {
    	$model = TaPenjualan::all();
    	return view('laporan/penjualan', ['model' => $model]);
    }

    public function GetPenjualan(Request $request) {

        $awal = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir = date('Y-m-d', strtotime($request->tgl_akhir));
        $model = TaPenjualan::whereBetween('tgl_penjualan', [$awal, $akhir])->get();

        $view = view("laporan/data-penjualan",compact('model'))->render();

        return response()->json(['html'=>$view]);
    }

    public function LaporanPembelian() {
    	$model = TaPembelian::all();
    	return view('laporan/pembelian', ['model' => $model]);
    }

    public function GetPembelian(Request $request) {

        $awal = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir = date('Y-m-d', strtotime($request->tgl_akhir));
        $model = TaPembelian::whereBetween('tanggal', [$awal, $akhir])->get();

        $view = view("laporan/data-pembelian",compact('model'))->render();

        return response()->json(['html'=>$view]);
    }

    public function PrintPenjualan(Request $request, $tgl_awal, $tgl_akhir) {

        $awal = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir = date('Y-m-d', strtotime($request->tgl_akhir));
        $model = TaPenjualan::whereBetween('tgl_penjualan', [$awal, $akhir])->get();

        $pdf = PDF::loadview('laporan/print-penjualan', [
            'model' => $model,
        ])->setPaper('a4');
        // ])->setPaper([0, 0, 612, 396]);

        return $pdf->stream();
    }

    public function PrintPembelian(Request $request, $tgl_awal, $tgl_akhir) {

        $awal = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir = date('Y-m-d', strtotime($request->tgl_akhir));
        $model = TaPembelian::whereBetween('tanggal', [$awal, $akhir])->get();

        $pdf = PDF::loadview('laporan/print-pembelian', [
            'model' => $model,
        ])->setPaper('a4');
        // ])->setPaper([0, 0, 612, 396]);

        return $pdf->stream();
    }
}
