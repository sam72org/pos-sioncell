@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            History Stok Barang
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <!-- <p><a href="/report/order-pdf" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-print"></i> PRINT PDF</a></p> -->
            <h3 class="box-title"><span class="fa fa-list"></span> History Stok Barang</h3>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json">
                <thead>
                    <tr>
                        <th class="title-order" style="text-align: center;">Tanggal</th>
                        <th class="title-order" style="text-align: center;">Tipe</th>
                        <th class="title-order" style="text-align: center;">Nama Barang</th>
                        <th class="title-order" style="text-align: center;">Qty</th>
                        <th class="title-order" style="text-align: center;">Saldo Stok</th>
                        <th class="title-order" style="text-align: center;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($model as $value): ?>
                        <tr>
                            <td style="text-align: center;">{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                            <td style="text-align: center;">{{ $value->tipe }}</td>
                            <td>{{ $value->barang->nama_barang }}</td>
                            <td style="text-align: right;">{{ $value->qty }}</td>
                            <td style="text-align: right;">{{ $value->stok }}</td>
                            <td>{{ $value->keterangan.", No. Invoice : ". $value->no_transaksi }}</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

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
        "order": [[ 0, "desc" ]]
    });
});
</script>
@endpush