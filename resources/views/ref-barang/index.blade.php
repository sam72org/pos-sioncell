@extends('layouts.app')

@section('content')

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
        .table-bordered > tfoot > tr > th {
            border : 1px solid #d1d1d1;
        }
    </style>
    
    <section class="content-header">
        <h1>
            Data Barang
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
            <?php if (auth()->user()->role == 'admin'): ?>
                <p><a href="{{ url('ref-barang/tambah') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a></p>
            <?php endif ?>
        </div>

        <div class="box-body">
            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
              </div>
            @endif
            <table class="table table-bordered table-striped tabel-json" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Barcode</th>
                        <th style="text-align: center;">Nama Barang</th>
                        <th style="text-align: center;">Kategori</th>
                        <th style="text-align: center;">Harga Jual</th>
                        <th style="text-align: center;">Harga Nego</th>
                        <?= auth()->user()->role == 'admin' ? '<th style="text-align: center;">Harga Modal</th>' : '' ?>
                        <th style="text-align: center;">Stok</th>
                        <?= auth()->user()->role == 'admin' ? '<th style="text-align: center;">Total</th>' : '' ?>
                        <?= auth()->user()->role == 'admin' ? '<th>Aksi</th>' : '' ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no     = 1;
                        $total  = 0;
                        $sum    = 0; 
                        foreach($model as $value): 
                        $total = $value->stok * $value->harga_beli;
                        $sum += $total;
                    ?>
                        <tr>
                            <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                            <td style="text-align: center; width: 12%;">{{ $value->kode_barcode }}</td>
                            <td style="text-align: left; width: 25%;">{{ $value->nama_barang }}</td>
                            <td style="text-align: center;">{{ $value->kategori->kategori }}</td>
                            <td style="text-align: right;">{{ number_format($value->harga_jual,0,",",".") }}</td>
                            <td style="text-align: right;">{{ number_format($value->harga_nego,0,",",".") }}</td>
                            <?php if (auth()->user()->role == 'admin'): ?>
                                <td style="text-align: right;">{{ number_format($value->harga_beli,0,",",".") }}</td>
                            <?php endif ?>
                            <td style="text-align: center;">{{ $value->stok }}</td>
                            <?php if (auth()->user()->role == 'admin'): ?>
                                <td style="text-align: right; width: 10%">{{ number_format($total,0,",",".") }}</td>
                                <td style="text-align: center; width: 5%;">
                                    <a href ="{{ url('ref-barang/ubah').'/'.$value->id }}" class="btn btn-xs btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> Ubah</a>
                                    <!-- <a href ="{{ url('ref-barang/hapus').'/'.$value->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a> -->
                                </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <?php if (auth()->user()->role == 'admin'): ?>
                    <tfoot>
                        <tr>
                            <th colspan="8" style="text-align: right;">Grand Total</th>
                            <th style="text-align: right;">{{ number_format($sum,0,",",".") }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                <?php endif ?>
            </table>
        </div>
    </div>
    <!-- /.box -->
    </section>
@stop

    
@push('scripts')
<script>
$(document).ready(function() {
    $('.tabel-json').DataTable();
});
</script>
@endpush