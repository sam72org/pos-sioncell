@extends('layouts.app')

@section('content')
    
    <section class="content-header">
        <h1>
            Data Penjualan
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
            <p><a href="{{ url('ta-penjualan/new-transaction') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Penjualan Baru</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped tabel-json">
                <thead>
                    <tr>
                        <th style="text-align: center;">No. Bukti</th>
                        <th style="text-align: center;">Nama Pelanggan</th>
                        <th style="text-align: center;">Total (Rp)</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Jatuh Tempo</th>
                        <th style="text-align: center;">Status </th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model as $data)
                    <tr>
                        <td>{{ $data->no_penjualan }}</td>
                        <td style="text-align: left;">
                            <?php if ($data->pelanggan_id == 0): ?>
                                Umum
                            <?php else: ?>
                                {{ $data->pelanggan->nama }}
                            <?php endif ?>
                        </td>
                        <td style="text-align: right;">{{ number_format($data->grand_total,0,",",".") }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->tgl_penjualan)) }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data->tgl_jatuh_tempo)) }}</td>
                        <td style="text-align: center;">{{ $data->status_pembayaran == 0 ? "Belum Bayar" : "Lunas" }}</td>
                        <td style="text-align: center;">
                            <!-- <a href ="{{ url('ta-penjualan/view-transaction').'/'.$data->no_penjualan }}" class="btn btn-sm btn-warning" style="margin-right:5px;" target="" title="Detail"><i class="fa fa-eye"></i> </a> -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-warning">Aksi</button>
                                <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('ta-penjualan/view-transaction').'/'.$data->no_penjualan }}">Lihat Detail</a></li>
                                    <?php if ($data->status_pembayaran == 0): ?>
                                        <li><a href="{{ url('ta-penjualan/konfirmasi-pembayaran').'/'.$data->id }}">Tandai Lunas</a></li>
                                    <?php else: ?>
                                        
                                    <?php endif ?>
                                </ul>
                            </div>
                            <!-- <a href ="ta-penjualan/print/{{ $data->no_penjualan }}" class="btn btn-small btn-primary" target="_blank"><i class="fa fa-print"></i> </a> -->
                        </td>
                    </tr>
                    @endforeach
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
