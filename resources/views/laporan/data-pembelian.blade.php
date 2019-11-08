<table class="table table-bordered tabel-json">       
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">No. Transaksi</th>
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
                <td>{{ $data->no_pembelian }}</td>
                <td style="text-align: left;">{{ $data->distributor->nama }}</td>
                <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->tanggal)) }}</td>
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