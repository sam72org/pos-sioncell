@extends('layouts.app')

@section('content')

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
        .table-bordered > tfoot > tr > td {
            border : 1px solid #d1d1d1;
        }
    </style>
    
    <section class="content-header">
        <h1>
            List Barang Terjual
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Penjualan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <!-- <p><a href="{{ url('ta-penjualan/new-transaction') }}" class="btn btn-flat btn-primary"> Point Of Sales/Kasir</a></p> -->
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped tabel-json">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">No. Faktur</th>
                        <th style="text-align: center;">Nama Barang</th>
                        <th style="text-align: center;">Kategori</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: center;">Harga</th>
                        <th style="text-align: center;">Total (Rp)</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $sum = 0; 
                    foreach ($model as $data):
                    $sum += $data->sub_total; 
                    ?>
                        <tr>
                            <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                            <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td style="text-align: center;">{{ $data->no_penjualan }}</td>
                            <td style="text-align: left;">{{ $data->barang->nama_barang }}</td>
                            <td style="text-align: left;">{{ $data->barang->kategori->kategori }}</td>
                            <td style="text-align: center;">{{ $data->qty }}</td>
                            <td style="text-align: right;">{{ number_format($data->harga,0,",",".") }}</td>
                            <td style="text-align: right;">{{ number_format($data->sub_total,0,",",".") }}</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: 800; text-transform: uppercase;">Grand Total</td>
                        <td style="text-align: right; font-weight: 800;">{{ number_format($sum,0,",",".") }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.box -->
    </section>

@stop


@push('scripts')
<script>
$(document).ready(function() {
    $('.tabel-json').DataTable({
        // "order": [[ 1, "desc" ]]
    });
});
</script>
@endpush
