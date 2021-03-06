<!DOCTYPE html>
<html>
    <head>
    <title>WELPOS | Print Laporan Pembelian Barang</title>
    </head>
    <style>
      @font-face {
        font-family: 'Arial';
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        src: url("font url");
      }
      body {
        font-family: Arial, sans-serif; 
      }
      .table td, th {
        border-top: 1px solid;
        border-bottom: 1px solid;
        border-right: 1px solid;
        border-left: 1px solid;
        padding: 5px 5px 5px 5px;
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
        margin-bottom: 5px;
        text-align: left;
      }
      </style>
    <body>

        <center>
            <h5 class="title">LAPORAN PEMBELIAN BARANG</h5>
            <h5 class="title2">ARIEL PONSEL</h5>
            <h5 class="subtitle">Tanggal : {{ date('d-m-Y', strtotime($awal)) }} s/d {{ date('d-m-Y', strtotime($akhir)) }}</h5>
        </center>

        <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">       
            <thead>
                <tr>
                    <th style="text-align: center; font-size: 12px; width: 20px;">No</th>
                    <th style="text-align: center; font-size: 12px; width: 100px;">No. Transaksi</th>
                    <th style="text-align: center; font-size: 12px; width: 200px">Nama Pelanggan</th>
                    <th style="text-align: center; font-size: 12px; width: 50px;">Tanggal</th>
                    <th style="text-align: center; font-size: 12px; width: 70px;">Total (Rp)</th>
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
                        <td style="font-size: 12px;">{{ $data->no_pembelian }}</td>
                        <td style="text-align: left; font-size: 12px;">{{ $data->distributor->nama }}</td>
                        <td style="text-align: center; font-size: 12px;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                        <td style="text-align: right; font-size: 12px;">{{ number_format($data->grand_total,0,",",".") }}</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align: right; font-size: 12px;">Grand Total</th>
                    <th style="text-align: right; font-size: 12px;">{{ number_format($sum,0,",",".") }}</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>