@extends('layouts.app')

@section('content')
    
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
            <p><a href="{{ url('ref-barang/tambah') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Barang Baru</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama Barang</th>
                        <th style="text-align: center;">Kategori</th>
                        <th style="text-align: center;">Harga Beli (Rp)</th>
                        <th style="text-align: center;">Stok</th>
                        <th style="text-align: center;">Total (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no=1;
                        $total=0;
                        $sum=0; 
                        foreach($model as $value): 
                        $total = $value->stok * $value->harga_beli;
                        $sum += $total;
                    ?>
                        <tr>
                            <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                            <td>{{ $value->nama_barang }}</td>
                            <td style="text-align: center;">{{ $value->kategori->kategori }}</td>
                            <td style="text-align: right;">{{ number_format($value->harga_beli,0,",",".") }}</td>
                            <td style="text-align: center;">{{ $value->stok }}</td>
                            <td style="text-align: right;">{{ number_format($total,0,",",".") }}</td>
                            <td style="text-align: center;">
                                <a href ="{{ url('ref-barang/ubah').'/'.$value->id }}" class="btn btn-sm btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> Ubah</a>
                                <!-- <a href ="{{ url('ref-barang/hapus').'/'.$value->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a> -->
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" style="text-align: right;">Grand Total</th>
                        <th style="text-align: right;">{{ number_format($sum,0,",",".") }}</th>
                        <th></th>
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
    $('.tabel-json').DataTable();
});
</script>
@endpush