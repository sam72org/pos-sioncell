<!DOCTYPE html>
<html>
    <head>
    <title>Laporan Penjualan</title>
    </head>
    <body>
        <style type="text/css">
            <?php include 'adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css';  ?>
            <?php include 'adminlte/dist/css/AdminLTE.min.css'; ?>

            .table {
                border: 1px solid #000;
            }
            .table th, .table td {
                border-right: 1px solid #000;
                border-left: 1px solid #000;
            }
            .table .content-order {
                font-size: 12px;
                font-weight: 600;
                border-top: 1px solid #000;
            }
            .table .title-order {
                border-bottom: 1px solid #000;
            }
            .table .content-menu {
                font-size: 12px;
            }

        </style>

        <center>
            <h4>LAPORAN PENJUALAN</h4>
        </center>

        <table class="table tabel-json">
            <thead>
                <tr>
                    <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">No. Order</th>
                    <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Nama Meja</th>
                    <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Waktu</th>
                    <th colspan="6" class="title-order" style="text-align: center;">Rincian</th>
                    <!-- <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Total (Rp)</th> -->
                    <!-- <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">PPN (10%)</th> -->
                    <!-- <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Grand Total (Rp)</th> -->  
                </tr>

                <tr>
                    <th class="title-order" style="text-align: center;">Menu</th>
                    <th class="title-order" style="text-align: center;">Harga</th>
                    <th class="title-order" style="text-align: center;">Qty</th>
                    <th class="title-order" style="text-align: center;">Sub Total</th>
                    <th class="title-order" style="text-align: center;">PPN (10%)</th>
                    <th class="title-order" style="text-align: center;">Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($model as $data): ?>
                    <tr>
                        <td class="content-order" style="text-align: left;">{{ $data->no_penjualan }}</td>
                        <td class="content-order" style="text-align: center">{{ $data->meja->meja }}</td>
                        <td class="content-order" style="text-align: center">{{ $data->created_at }}</td>
                        <td class="content-order"></td>
                        <td class="content-order"></td>
                        <td class="content-order"></td>
                        <td class="content-order"></td>
                        <td class="content-order"></td>
                        <td class="content-order" style="text-align: right; font-weight: 600">
                            {{ number_format($data->grand_total, 0,",",".") }}
                        </td>   
                    </tr>

                    <?php foreach (\App\TaDetailPenjualan::where('no_penjualan', $data->no_penjualan)->get() as $value):
                        $pp_sub =  ($value->sub_total * 10) / 100;
                        $subTotalPpn = $value->sub_total + $pp_sub;
                    ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="content-menu" style="padding-left: 20px; text-align: left;">{{ $value->menu->menu }}</td>
                            <td class="content-menu" style="text-align: right;">{{ number_format($value->menu->harga, 0,",",".") }}</td>
                            <td class="content-menu" style="text-align: center;">{{ $value->qty }}</td>
                            <td class="content-menu" style="text-align: right;">
                                {{ number_format($value->sub_total, 0,",",".") }}
                            </td>
                            <td class="content-menu" style="text-align: right;">
                                {{ number_format($pp_sub, 0,",",".") }}
                            </td>
                            <td class="content-menu" style="text-align: right;">
                                {{ number_format($subTotalPpn, 0,",",".") }}
                            </td>
                            <!-- <td></td> -->
                        </tr>
                    <?php endforeach ?>
                <?php endforeach ?>
            </tbody>
        </table>

    </body>
</html>
