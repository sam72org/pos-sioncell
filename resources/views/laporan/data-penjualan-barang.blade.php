
<style type="text/css">
    .table-bordered {
        border : 1px solid #d1d1d1;
    }
    .table-bordered > thead > tr > th {
        border : 1px solid #d1d1d1;
    }
    .table-bordered > tbody > tr > td {
        border : 1px solid #d1d1d1;
    }
    .table-bordered > tfoot > tr > th {
        border : 1px solid #d1d1d1;
    }
    
</style>

<table class="table table-bordered table-striped tabel-json">       
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">No. Faktur</th>
            <th style="text-align: center;">Kasir</th>
            <th style="text-align: center;">Tanggal</th>
            <th style="text-align: center;">Total (Rp)</th>
        </tr>
    </thead>
    <tbody >
        <?php 
            $no     = 1; 
            $sum    = 0;

            foreach ($model as $data) :
            $sum += $data->grand_total;
        ?>
            <tr>
                <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                <td style="text-align: center; width: 15%;">{{ $data->no_penjualan }}</td>
                <td style="text-align: center; width: 40%;">{{ $data->user->name }}</td>
                <td style="text-align: center; width: 15%;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                <td style="text-align: right; width: 15%;">{{ number_format($data->grand_total,0,",",".") }}</td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <?php
            $jlh_modal  = 0;
            if ($user == 0) {
                $model2 = DB::table('ta_detail_penjualan')
                    ->join('ta_penjualan', 'ta_detail_penjualan.ta_penjualan_id', '=', 'ta_penjualan.id')
                    ->join('ref_barang', 'ta_detail_penjualan.barang_id', '=', 'ref_barang.id')
                    ->whereBetween('ta_detail_penjualan.created_at', [$awal." 00:00:00", $akhir." 23:59:59"])
                    ->select('ta_detail_penjualan.qty', 'ref_barang.harga_beli')
                    ->get();
            }
            else {
                $model2 = DB::table('ta_detail_penjualan')
                    ->join('ta_penjualan', 'ta_detail_penjualan.ta_penjualan_id', '=', 'ta_penjualan.id')
                    ->join('ref_barang', 'ta_detail_penjualan.barang_id', '=', 'ref_barang.id')
                    ->whereBetween('ta_detail_penjualan.created_at', [$awal." 00:00:00", $akhir." 23:59:59"])
                    ->where('ta_penjualan.user_id', $user)
                    ->select('ta_detail_penjualan.qty', 'ref_barang.harga_beli')
                    ->get();
            }
            foreach ($model2 as $data2) {
                $jlh_modal += $data2->qty * $data2->harga_beli;
            }
        ?>
        <tr>
            <th colspan="4" style="text-align: right; text-transform: uppercase;">Grand Total</th>
            <th style="text-align: right;">{{ number_format($sum,0,",",".") }}</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right; text-transform: uppercase;">Modal</th>
            <th style="text-align: right;">{{ number_format($jlh_modal,0,",",".") }}</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right; text-transform: uppercase;">Keuntungan</th>
            <th style="text-align: right;">{{ number_format($sum - $jlh_modal,0,",",".") }}</th>
        </tr>
    </tfoot>
</table>
