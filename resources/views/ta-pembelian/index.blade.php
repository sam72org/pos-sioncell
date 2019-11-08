@extends('layouts.app')

@section('content')
    
    <section class="content-header">
        <h1>
            Data Pembelian
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
            <p><a href="{{ url('ta-penjualan/new-transaction') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Pembelian Baru</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json">
                <thead>
                    <tr>
                        <td style="text-align: center;">No</td>
                        <th style="text-align: center;">No. Bukti</th>
                        <th style="text-align: center;">Nama Distributor</th>
                        <th style="text-align: center;">Total (Rp)</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($model as $data) : ?>
                        <tr>
                            <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                            <td style="text-align: center;">{{ $data->no_pembelian }}</td>
                            <td style="text-align: center;">{{ $data->distributor->nama }}</td>
                            <td style="text-align: right;">{{ number_format($data->grand_total,0,",",".") }}</td>
                            <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->tanggal)) }}</td>
                            <td style="text-align: center;">
                                <a href ="{{ url('ta-pembelian/view-transaction').'/'.$data->no_pembelian }}" class="btn btn-sm btn-warning" style="margin-right:5px;" target="" title="Lihat Detail">Lihat Detail </a>
                                <!-- <a href ="ta-penjualan/print/{{ $data->no_penjualan }}" class="btn btn-small btn-primary" target="_blank"><i class="fa fa-print"></i> </a> -->
                            </td>
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
    $('.tabel-json').DataTable();
});
</script>
@endpush
