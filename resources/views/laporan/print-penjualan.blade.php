<!DOCTYPE html>
<html>
    <head>
    <title>Print Penjualan</title>
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
      .table td, th {
        border-top: 1px solid;
        border-bottom: 1px solid;
        border-right: 1px solid;
        border-left: 1px solid;
        padding: 5px 5px 5px 5px;
      }
      </style>
    <body>

        <center>
            <h4 style="text-decoration: underline;">LAPORAN PENJUALAN</h4>
        </center>

        <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">       
            <thead>
                <tr>
                    <th style="text-align: center; font-size: 12px; width: 20px;">No</th>
                    <th style="text-align: center; font-size: 12px; width: 100px;">No. Faktur</th>
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
                        <td style="font-size: 12px;">{{ $data->no_penjualan }}</td>
                        <td style="text-align: left; font-size: 12px;">
                            <?php if ($data->pelanggan_id == 0): ?>
                                Umum
                            <?php else: ?>
                                {{ $data->pelanggan->nama }}
                            <?php endif ?>
                        </td>
                        <td style="text-align: center; font-size: 12px;">{{ date('d-m-Y', strtotime($data->tgl_penjualan)) }}</td>
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