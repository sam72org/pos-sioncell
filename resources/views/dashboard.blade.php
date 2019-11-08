@extends('layouts.app')

@section('content')
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
                    <span class="info-box-text">Transaksi Penjualan</span>
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
                    <span class="info-box-text">Transaksi Pembelian</span>
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
                    <span class="info-box-text">Barang</span>
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
                    <span class="info-box-text">Pelanggan</span>
                    <span class="info-box-number">{{ $jlh_pelanggan }}</span>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">No. Faktur</th>
                                <th style="text-align: center;">Pelanggan</th>
                                <th style="text-align: center;">Total (Rp)</th>
                                <th style="text-align: center;">Waktu</th>
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
                                <td style="text-align: center;">{{ $value->pelanggan_id == 0 ? "Umum" : $value->pelanggan->nama }}</td>
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