@extends('layouts.app')

@section('content')
    
    <section class="content-header">
        <h1>
            Detail Penjualan
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('ta-penjualan/index') }}">Penjualan</a></li>
            <li class="active">View</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border"> 
                <h2 class="box-title"><i class="fa fa-info"></i> Detail Penjualan Barang #{{ $model1->no_penjualan }}</h2>
            </div>
            
            <div class="box-body">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b>No. Faktur <span style="padding-left: 55px; padding-right: 10px;"> : </span> {{ $model1->no_penjualan }}</b><br>
                        <b>Kasir <span style="padding-left: 88px; padding-right: 10px;"> : </b></span> {{ $model1->user->name }}
                        <br>
                        <b>Waktu Transaksi <span style="padding-left: 18px; padding-right: 10px;"> : </b></span> {{ date('d-m-Y H:i', strtotime($model1->created_at)) }}
                        <br><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th style="text-align: center;">Harga</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: right;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;
                                    foreach ($model2 as $value) :
                                        $barang = DB::table('ref_barang')->where('id', $value->barang_id)->first();
                                        $subtotal = $value->sub_total;
                                        $total += $subtotal;
                                    ?>
                                        <tr>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td style="text-align: center;">{{ number_format($value->harga,0,",",".") }}</td>
                                            <td style="text-align: center;">{{ $value->qty }}</td>
                                            <td style="text-align: right;">{{ number_format($subtotal,0,",",".") }}</td>
                                        </tr>
                                    <?php endforeach ;
                                ?>
                            </tbody>
                        </table>

                        <h4 style=" margin-right: 10px;">
                        <input type="text" hidden="true" id="uang_total" value="{{ $total }}">
                        <b class="pull-right">Rp <?= number_format($total,0,",",".") ?></b>
                        <span><b>Total</b></span>
                        </h4>
                        <br>
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-xs-12">
                        <a href ="{{ url('ta-penjualan/index') }}" class="btn btn-small btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a href ="{{ url('ta-penjualan/print-transaction').'/'.$model1->no_penjualan }}" class="btn btn-small btn-primary" target="_blank" title=""><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection