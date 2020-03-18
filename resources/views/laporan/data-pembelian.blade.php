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

<table class="table table-bordered tabel-json">       
    <thead>
        <tr>
            <th style="text-align: center; width: 5%;">No</th>
            <th style="text-align: center; width: 15%;">No. Transaksi</th>
            <th style="text-align: center;">Distributor</th>
            <th style="text-align: center;">Tanggal</th>
            <th style="text-align: center;">Total (Rp)</th>
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
                <td style="text-align: center;">{{ $no++ }}</td>
                <td style="text-align: center;">{{ $data->no_pembelian }}</td>
                <td style="text-align: left;">{{ $data->distributor->nama }}</td>
                <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                <td style="text-align: right;">{{ number_format($data->grand_total,0,",",".") }}</td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" style="text-align: right;">Grand Total</th>
            <th style="text-align: right;">{{ number_format($sum,0,",",".") }}</th>
        </tr>
    </tfoot>
</table>