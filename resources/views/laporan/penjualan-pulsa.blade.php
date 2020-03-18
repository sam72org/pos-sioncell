@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Laporan Penjualan Pulsa
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
            <!-- <h3 class="box-title"><span class="fa fa-list"></span> Laporan Penjualan</h3> -->
            <div class="row">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-1" style="text-align: center;">
                        <label style="margin-top: 8px;">Periode</label>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                        <button class="btn btn-flat btn-primary" id="btn_laporan_cari_pulsa"><i class="fa fa-search"></i> Tampilkan</button>

                        <input type="hidden" id="tgl-awal">
                        <input type="hidden" id="tgl-akhir">
                        <button class="btn btn-flat btn-warning" id="btn_print_penjualan_pulsa"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="box-body" id="data-penjualan-pulsa">
            
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

$('#tgl_awal').blur(function() {
    var awal = $('#tgl_awal').val();
    $('#tgl-awal').val(awal);
    
});

$('#tgl_awal').blur(function() {
    var awal = $('#tgl_awal').val();
    $('#tgl-awal').val(awal);
    
});

$(document).on('click', '#btn_laporan_cari_pulsa', function(e) {
    e.preventDefault();

    var tgl_awal   = $('#tgl_awal').val();
    var tgl_akhir  = $('#tgl_akhir').val();


    $('#tgl-awal').val(tgl_awal);
    $('#tgl-akhir').val(tgl_akhir);

    if (tgl_awal == '') {
        alert ('Silahkan Pilih Periode Tanggal Awal!');
    }
    else if (tgl_akhir == '') {
        alert ('Silahkan Pilih Periode Tanggal Akhir !');
    }
    else {
        $.ajax({
            type: "GET",
            url: "get-penjualan-pulsa",
            data: {
                'tgl_awal' : tgl_awal,
                'tgl_akhir' : tgl_akhir,
            },
            success: function(data) {
                $('#data-penjualan-pulsa').html(data.html);
            },
        });
    }
});

$(document).on('click', '#btn_print_penjualan_pulsa', function(e) {
    e.preventDefault();

    var tgl_awal   = $('#tgl_awal').val();
    var tgl_akhir  = $('#tgl_akhir').val();

    if (tgl_awal == '') {
        alert ('Silahkan Pilih Periode Tanggal Awal!');
    }
    else if (tgl_akhir == '') {
        alert ('Silahkan Pilih Periode Tanggal Akhir !');
    }
    else {
        window.open('print-penjualan-pulsa/' + tgl_awal + '/' + tgl_akhir, '_blank');
    }
});

</script>
@endpush