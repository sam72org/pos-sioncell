<?php

namespace App\Http\Controllers;
use App\TaHistoryBarang;
use App\TaPenjualan;
use App\TaPulsa;
use App\TaJasa;
use App\TaDetailPenjualan;
use App\TaPembelian;
use App\User;
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
    	$user = User::all();
    	return view('laporan/penjualan-barang', ['model' => $model, 'user' => $user]);
    }

    public function GetPenjualan(Request $request) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $user   = $request->user;

        if ($user == 0) {
            $model = TaPenjualan::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])->get(); 
        } 
        else {
            $model = TaPenjualan::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])
                    ->where('user_id', $user)
                    ->get();
        }

        $view   = view("laporan/data-penjualan-barang",compact('model', 'awal', 'akhir', 'user'))->render();
        return response()->json(['html' => $view]);
    }

    public function PrintPenjualan(Request $request) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $user   = $request->user;
        $datauser = User::where('id', $user)->first();

        if ($user == 0) {
            $model = TaPenjualan::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])->get(); 
        } 
        else {
            $model = TaPenjualan::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])
                    ->where('user_id', $user)
                    ->get();
        }

        $pdf = PDF::loadview('laporan/print-penjualan-barang', [
            'model' => $model,
            'awal' => $awal,
            'user' => $user,
            'datauser' => $datauser,
            'akhir' => $akhir,
        ])->setPaper('a4');
        // ])->setPaper([0, 0, 612, 396]);

        return $pdf->stream();
    }

    public function LaporanPembelian() {
    	$model = TaPembelian::all();
    	return view('laporan/pembelian', ['model' => $model]);
    }

    public function GetPembelian(Request $request) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $model  = TaPembelian::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])->get();
        $view   = view("laporan/data-pembelian",compact('model'))->render();

        return response()->json(['html'=>$view]);
    }

    public function PrintPembelian(Request $request) {

        $awal = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir = date('Y-m-d', strtotime($request->tgl_akhir));
        $model = TaPembelian::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])->get();

        $pdf = PDF::loadview('laporan/print-pembelian', [
            'model' => $model,
            'awal' => $awal,
            'akhir' => $akhir,
        ])->setPaper('a4');
        // ])->setPaper([0, 0, 612, 396]);

        return $pdf->stream();
    }

    public function LaporanPenjualanPulsa() {
        return view('laporan/penjualan-pulsa');
    }

    public function GetPenjualanPulsa(Request $request) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $model  = TaPulsa::whereBetween('created_at', [$awal, $akhir])->orderBy('id', 'ASC')->get();
        $view   = view("laporan/data-penjualan-pulsa",compact('model', 'awal', 'akhir'))->render();

        return response()->json(['html'=>$view]);
    }

    public function PrintPenjualanPulsa(Request $request, $tgl_awal, $tgl_akhir) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $model  = TaPulsa::whereBetween('created_at', [$awal, $akhir])->orderBy('id', 'ASC')->get();

        $pdf = PDF::loadview('laporan/print-penjualan-pulsa', [
            'model' => $model,
            'awal' => $tgl_awal,
            'akhir' => $tgl_akhir,
        ])->setPaper('a4');

        return $pdf->stream();
    }

    public function LaporanPenjualanJasa() {
        return view('laporan/penjualan-jasa');
    }

    public function GetPenjualanJasa(Request $request) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $model  = TaJasa::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])->get();
        $view   = view("laporan/data-penjualan-jasa",compact('model', 'awal', 'akhir'))->render();

        return response()->json(['html'=>$view]);
    }

    public function PrintPenjualanJasa(Request $request) {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $model  = TaJasa::whereRaw("(created_at >= ? AND created_at <= ?)", [$awal." 00:00:00", $akhir." 23:59:59"])->get();

        $pdf = PDF::loadview('laporan/print-penjualan-jasa', [
            'model' => $model,
            'awal' => $awal,
            'akhir' => $akhir,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function LaporanLabaRugi() {

        $awal   = date('Y-m-d', strtotime($request->tgl_awal));
        $akhir  = date('Y-m-d', strtotime($request->tgl_akhir));
        $model  = TaPenjualan::whereBetween('tgl_penjualan', [$awal, $akhir])->get();
        $model2 = TaPembelian::whereBetween('tgl_penjualan', [$awal, $akhir])->get();

    }
}
