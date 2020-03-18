@extends('layouts.app')

@section('content')

<style type="text/css">
    .table-bordered {
        border : 1px solid #d1d1d1;
    }
    .table-bordered > tbody > tr > td {
        border : 1px solid #d1d1d1;
        vertical-align: middle;
    }
    .table-bordered > thead > tr > th {
        border : 1px solid #d1d1d1;
    }
</style>

<section class="content-header">
    <h1>
        Dashboard
        <small>{{ date('d-m-Y H:i') }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-send-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Penjualan Barang</span>
                    <span class="info-box-number">{{ $jlh_penjualan }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pembelian Barang</span>
                    <span class="info-box-number">{{ $jlh_pembelian }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-table"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data Barang</span>
                    <span class="info-box-number">{{ $jlh_barang }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">User</span>
                    <span class="info-box-number">{{ $jlh_user }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><span class="fa fa-info"></span> Penjualan Terakhir</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%;">#</th>
                                <th style="text-align: center;">No. Faktur</th>
                                <th style="text-align: center;">Kasir</th>
                                <th style="text-align: center;">Total</th>
                                <th style="text-align: center;">Waktu Transaksi</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($model as $value) : 
                            // $meja = DB::table('ref_meja')->where('id', $value->meja_id)->first();
                        ?>
                            <tr>
                                <td style="text-align: center;">{{ $no++ }}</td>
                                <td style="text-align: center;">{{ $value->no_penjualan }}</td>
                                <td style="text-align: center;">{{ $value->user->name }}</td>
                                <td style="text-align: right;">{{ number_format($value->grand_total,0,",",".") }}</td>
                                <td style="text-align: center;">{{ date('d-m-Y H:i', strtotime($value->created_at)) }}</td>
                            </tr>
                        <?php endforeach ; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection