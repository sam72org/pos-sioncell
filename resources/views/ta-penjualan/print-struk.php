<!DOCTYPE html>
<html>
    <head>
    <title>Print Order</title>
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
      </style>
    <body>

       <!--  <center>
            <h4 style="text-decoration: underline;">INVOICE</h4>
        </center> -->

        <table width="100%" class="table" style="margin-top: -20px;">
            <?php 
                $data_penjualan = \App\TaPenjualan::where('no_penjualan', $no_penjualan)->first();
            ?>

            <tbody>
                <tr>
                    <td colspan="2" style="font-size: 14px; width: 250px;"><b>FAKTUR PENJUALAN</b></td>
                    <td style="font-size: 12px; width: 50px;">KEPADA</td>
                    <td style="font-size: 12px; width: 150px; text-transform: uppercase; padding-left: -5px;"> : <b><?= $data_penjualan->pelanggan_id == 0 ? "-" : $data_penjualan->pelanggan->nama ?></b></td>
                </tr>
            </tbody>
        </table>

        <table width="100%" class="table">
            <tbody>
                <tr>
                    <td style="font-size: 12px; width: 80px;">No. Faktur </td>
                    <td style="font-size: 12px; width: 5px;">:</td>
                    <td style="font-size: 12px; width: 390px;"><?= $no_penjualan ?></td>
                    <td style="font-size: 12px;"> <?= $data_penjualan->pelanggan_id == 0 ? "" : $data_penjualan->pelanggan->alamat ?></b></td>
                </tr>
                <tr>
                    <td style="font-size: 12px;">Tanggal</td>
                    <td style="font-size: 12px;">:</td>
                    <td colspan="2" style="font-size: 12px; "><?= date('d F Y') ?></td>
                </tr>
            </tbody>
        </table>

        <table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr style="border: 0px;">
                    <th style="text-align:center; font-size: 12px; border-top: 1px solid; border-bottom: 1px solid; padding-top: 5px; padding-bottom: 5px; width: 5%">No.</th>
                    <th style="text-align:left; font-size: 12px; border-top: 1px solid; border-bottom: 1px solid; padding-top: 5px; padding-bottom: 5px;">Nama Barang</th>
                    <th style="text-align:center; font-size: 12px; border-top: 1px solid; border-bottom: 1px solid;">Qty</th>
                    <th style="text-align:right; font-size: 12px; border-top: 1px solid; border-bottom: 1px solid;">Harga</th>
                    <th style="text-align:right; font-size: 12px; border-top: 1px solid; border-bottom: 1px solid;">Sub Total</th>
                </tr>
            </thead>
            <tbody>   
                <?php 
                    $total = 0;
                    $jlh_qty = 0;
                    $no = 0;
                    foreach($model as $data) :
                    $no++; 
                    $total += $data->sub_total;
                    $jlh_qty += $data->qty;
                ?>
                <tr>
                    <td id="tbody" style="text-align: center; font-size: 12px; padding-bottom: 2px"><?= $no ?></td>
                    <td id="tbody" style="text-align: left; font-size: 12px; padding-bottom: 2px"><?= $data->barang->nama_barang ?></td>
                    <td id="tbody" style="text-align: center; font-size: 12px; width: 20%; padding-bottom: 2px"><?= $data->qty ?> </td>
                    <td id="tbody" style="text-align: right; font-size: 12px; width: 15%; padding-bottom: 2px"><?= number_format($data->harga, 0,",",".") ?><</td>
                    <td id="tbody" style="text-align: right; font-size: 12px; width: 15%; padding-bottom: 2px"><?= number_format($data->sub_total, 0,",",".") ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="font-size: 12px; border-top: 1px solid solid; padding: 5px 0px; font-style: italic;">JATUH TEMPO : <?= date('d F Y', strtotime($data_penjualan->tgl_jatuh_tempo)) ?></td>
                    <td style="font-size: 12px; border-top: 1px solid solid; padding: 5px 0px;"></td>
                    <td style="font-size: 12px; border-top: 1px solid solid; padding: 5px 0px; text-align: right;"><b>TOTAL</b></td>
                    <td style="text-align: right; font-size: 12px; border-top: 1px solid solid; padding: 5px 0px;"><b>Rp <?= number_format($total, 0,",",".") ?></b></td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 12px; font-style: italic;"><b>
                        Catatan : <br>
                        REK BRI = 529501000 605 505 A/N ARIFIN ARITONANG;<br>
                        REK MANDIRI = 105-00-1406-0804 A/N ARIFIN ARITONANG;
                        </b>
                    </td>
                </tr>
            </tfoot>
        </table>

        <table class="table" width="100%">
            <tbody>
                <tr>
                    <td style="font-size: 12px; text-align: center;">Yang Menerima,</td>
                    <td style="width: 30%"></td>
                    <td style="width: 30%"></td>
                    <td style="font-size: 12px; text-align: center;">Hormat Kami,</td>
                </tr>
                <!-- <tr>
                    <td style="font-size: 12px;"></td>
                    <td></td>
                    <td></td>
                    <td style="font-size: 12px; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="font-size: 12px; border-bottom: 1px dotted; padding-top: 20px;"></td>
                    <td></td>
                    <td></td>
                    <td style="font-size: 12px; text-align: right; border-bottom: 1px dotted; padding-top: 20px;"></td>
                </tr> -->
            </tbody>
        </table>
    </body>
</html>