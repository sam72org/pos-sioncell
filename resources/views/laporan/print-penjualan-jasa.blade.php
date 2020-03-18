<!DOCTYPE html>
<html>
    <head>
    <title>Laporan Penjualan Jasa</title>
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
        font-size: 12px;
      }
      .title {
        font-size: 16px;
        margin-bottom: -15px;
        text-align: center;
      }
      .subtitle {
        font-size: 14px;
        margin-bottom: 20px;
        text-align: center;
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

 
        <h5 class="title">LAPORAN PENJUALAN JASA</h5>
        <h5 class="subtitle">{{ $awal }} s/d {{ $akhir }}</h5>

        <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">       
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Pelanggan</th>
                    <th style="text-align: center;">No HP</th>
                    <th style="text-align: center;">Keterangan</th>
                    <th style="text-align: center;">Teknisi</th>
                    <th style="text-align: center;">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1; 
                    $sum = 0; 
                    foreach ($model as $data) :
                    $sum += $data->harga;
                ?>
                    <tr>
                        <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                        <td style="text-align: center; width: 10%">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                        <td style="text-align: left; width: 15%">{{ $data->nama }}</td>
                        <td style="text-align: center; width: 10%;">{{ $data->no_hp }}</td>
                        <td style="text-align: left;">{{ $data->ket }}</td>
                        <td style="text-align: left; width: 15%;">{{ $data->teknisi }}</td>
                        <td style="text-align: right; width: 10%;">{{ number_format($data->harga,0,",",".") }}</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" style="text-align: right; border">Total</th>
                    <th style="text-align: right;">{{ number_format($sum,0,",",".") }}</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>