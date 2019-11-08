<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaPenjualan;
use App\RefMeja;
use App\RefMenu;
use App\TaDetailPenjualan;
use Datatables;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function listOrder() {
        $model = TaPenjualan::orderBy('no_penjualan', 'DESC')->get();
        // $model = TaPenjualan::all();
    	return view('report/order_list', ['model' => $model]);
    }

    public function orderPdf() {
    	$model = TaPenjualan::orderBy('no_penjualan', 'DESC')->get();
    	// $model = TaPenjualan::all();
    	$pdf = PDF::loadview('report/order_pdf', ['model' => $model])->setPaper('a4', 'landscape');

    	return $pdf->stream();
    	// return $pdf->download('laporan-order.pdf');
    }

}