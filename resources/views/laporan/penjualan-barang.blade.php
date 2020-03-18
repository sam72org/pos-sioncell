@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Laporan Penjualan Barang
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
            <div class="row">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-1" style="text-align: center;">
                        <label style="margin-top: 8px;">Periode</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="date form-control pull-right" autocomplete="off" placeholder="Tanggal Awal" id="tgl_awal">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" style="text-align: center;">
                        <label style="margin-top: 8px;">sampai</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="date form-control pull-right" autocomplete="off" placeholder="Tanggal Akhir" id="tgl_akhir">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="user" id="user" class="form-control">
                                <option value="0">Pilih Semua</option>
                                @foreach($user as $data)
                                <option value="{{ $data->id }}"> {{ $data->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-flat btn-primary" id="btn-laporan-cari"><i class="fa fa-search"></i> Tampilkan</button>
                        <button class="btn btn-flat btn-warning" id="btn-print-penjualan"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="box-body" id="data-penjualan">
            
        </div>
    </div>
    <!-- /.box -->
    </section>
@stop

@push('scripts')
<script>

$(document).ready(function() {
    $('.tabel-json').DataTable({
    });
});


$(document).on('click', '#btn-laporan-cari', function(e) {
    e.preventDefault();

    var tgl_awal    = $('#tgl_awal').val();
    var tgl_akhir   = $('#tgl_akhir').val();
    var user        = $('#user').val();

    if (tgl_awal == '') {
        alert ('Silahkan Pilih Periode Tanggal Awal!');
    }
    else if (tgl_akhir == '') {
        alert ('Silahkan Pilih Periode Tanggal Akhir !');
    }
    else {
        $.ajax({
            type: "GET",
            url: "get-penjualan",
            data: {
                'tgl_awal' : tgl_awal,
                'tgl_akhir' : tgl_akhir,
                'user' : user,
            },
            success: function(data) {
                $('#data-penjualan').html(data.html);
            },
        });
    }
});

$(document).on('click', '#btn-print-penjualan', function(e) {
    e.preventDefault();

    var tgl_awal   = $('#tgl_awal').val();
    var tgl_akhir  = $('#tgl_akhir').val();
    var user       = $('#user').val();

    if (tgl_awal == '') {
        alert ('Silahkan Pilih Periode Tanggal Awal!');
    }
    else if (tgl_akhir == '') {
        alert ('Silahkan Pilih Periode Tanggal Akhir !');
    }
    else {
        window.open('print-penjualan/' + tgl_awal + '/' + tgl_akhir + '/' + user, '_blank');
    }
});

</script>
@endpush