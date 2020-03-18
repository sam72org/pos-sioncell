
<style type="text/css">
    .table-bordered {
        border : 1px solid #d1d1d1;
    }
    .table-bordered > tbody > tr > td {
        border : 1px solid #d1d1d1;
    }
    .table-bordered > thead > tr > th {
        border : 1px solid #d1d1d1;
    }
</style>
    
<table class="table table-bordered table-striped tabel-json">       
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Tanggal</th>
            <th style="text-align: center;">Kategori</th>
            <th style="text-align: center;">Operator</th>
            <th style="text-align: center;">No HP</th>
            <th style="text-align: center;">Nominal</th>
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
                <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                <td style="text-align: center;">{{ $data->kategori }}</td>
                <td style="text-align: center;">{{ $data->operator }}</td>
                <td style="text-align: center;">{{ $data->no_hp }}</td>
                <td style="text-align: right;">{{ number_format($data->nominal,0,",",".") }}</td>
                <td style="text-align: right;">{{ number_format($data->harga,0,",",".") }}</td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="text-align: right;">Total</th>
            <th style="text-align: right;">{{ number_format($sum,0,",",".") }}</th>
        </tr>
    </tfoot>
</table>
