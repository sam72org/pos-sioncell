<!DOCTYPE html>
<html>
    <head>
    <title>Cetak Laporan Penjualan Barang</title>
    </head>
    <style>
      @font-face {
        font-family: 'Tahoma';
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        src: url("font url");
      }
      body {
        font-family: Tahoma, sans-serif; 
      }
      .title {
        font-size: 16px;
        margin-bottom: -25px;
        text-align: center;
      }
      .title2 {
        font-size: 16px;
        margin-bottom: 0px;
        text-align: center;
      }
      .subtitle {
        font-size: 12px;
        margin-bottom: -25px;
        text-align: left;
      }
      .subtitle2 {
        font-size: 12px;
        margin-bottom: 10px;
        text-align: left;
      }
      .table td, th {
        border-top: 1px solid;
        border-bottom: 1px solid;
        border-right: 1px solid;
        border-left: 1px solid;
        padding: 5px 5px 5px 5px;
      }
      </style>
    <body>

        <h5 class="title">LAPORAN PENJUALAN BARANG</h5>
        <h5 class="title2">ARIEL PONSEL</h5>
        <h5 class="subtitle">Tanggal <span style="margin-left: 5px;">:</span> {{  date('d-m-Y', strtotime($awal)) }} s/d {{  date('d-m-Y', strtotime($akhir)) }}</h5>
        <?php if ($user == 0): ?>
        <h5 class="subtitle2">Kasir <span style="margin-left: 22px;">:</span> -</h5>
        <?php else: ?>
        <h5 class="subtitle2">Kasir <span style="margin-left: 22px;">:</span> {{ $datauser->name }}</h5>    
        <?php endif ?>

        <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">       
            <thead>
                <tr>
                    <th style="text-align: center; font-size: 12px; width: 7%;">No</th>
                    <th style="text-align: center; font-size: 12px; width: 15%;">No. Faktur</th>
                    <th style="text-align: center; font-size: 12px; width: 30%;">Kasir</th>
                    <th style="text-align: center; font-size: 12px; width: 15%;">Tanggal</th>
                    <th style="text-align: center; font-size: 12px; width: 15%;">Total</th>
                </tr>
            </thead>
            <tbody >
                <?php
                    $no = 1;
                    $sum = 0; 
                    foreach ($model as $data):
                    $sum += $data->grand_total; 
                ?>
                    <tr>
                        <td style="text-align: center; font-size: 12px;">{{ $no++ }}</td>
                        <td style="text-align: center; font-size: 12px;">{{ $data->no_penjualan }}</td>
                        <td style="text-align: center; font-size: 12px;">{{ $data->user->name }}</td>
                        <td style="text-align: center; font-size: 12px;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                        <td style="text-align: right; font-size: 12px;">{{ number_format($data->grand_total,0,",",".") }}</td>
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
                    <th colspan="4" style="text-align: right; font-size: 12px;">Grand Total</th>
                    <th style="text-align: right; font-size: 12px;">{{ number_format($sum,0,",",".") }}</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: right; font-size: 12px;">Modal</th>
                    <th style="text-align: right; font-size: 12px;">{{ number_format($jlh_modal,0,",",".") }}</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: right; font-size: 12px;">Keuntungan</th>
                    <th style="text-align: right; font-size: 12px;">{{ number_format($sum - $jlh_modal,0,",",".") }}</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>