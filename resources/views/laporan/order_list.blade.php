@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            List Order
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
            <p><a href="/report/order-pdf" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-print"></i> PRINT PDF</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json">

            <thead>
                <tr>
                    <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">No. Order</th>
                    <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Nama Meja</th>
                    <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Waktu</th>
                    <th colspan="6" class="title-order" style="text-align: center;">Rincian</th>
                    <!-- <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Total (Rp)</th> -->
                    <!-- <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">PPN (10%)</th> -->
                    <!-- <th rowspan="2" class="title-order" style="text-align: center; vertical-align: middle;">Grand Total (Rp)</th> -->  
                </tr>

                <tr>
                    <th class="title-order" style="text-align: center;">Menu</th>
                    <th class="title-order" style="text-align: center;">Harga</th>
                    <th class="title-order" style="text-align: center;">Qty</th>
                    <th class="title-order" style="text-align: center;">Sub Total</th>
                    <th class="title-order" style="text-align: center;">PPN (10%)</th>
                    <th class="title-order" style="text-align: center;">Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($model as $data): ?>
                    <tr>
                        <td class="content-order" style="text-align: left;">{{ $data->no_penjualan }}</td>
                        <td class="content-order" style="text-align: center">{{ $data->meja->meja }}</td>
                        <td class="content-order" style="text-align: center">{{ $data->created_at }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="content-order" style="text-align: right; font-weight: 800; ">
                            {{ number_format($data->grand_total, 0,",",".") }}
                        </td>   
                    </tr>

                    <?php foreach (\App\TaDetailPenjualan::where('no_penjualan', $data->no_penjualan)->get() as $value):
                        $pp_sub =  ($value->sub_total * 10) / 100;
                        $subTotalPpn = $value->sub_total + $pp_sub;
                    ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="content-menu" style="padding-left: 20px; text-align: left;">{{ $value->menu->menu }}</td>
                            <td class="content-menu" style="text-align: right;">{{ number_format($value->menu->harga, 0,",",".") }}</td>
                            <td class="content-menu" style="text-align: center;">{{ $value->qty }}</td>
                            <td class="content-menu" style="text-align: right;">
                                {{ number_format($value->sub_total, 0,",",".") }}
                            </td>
                            <td class="content-menu" style="text-align: right;">
                                {{ number_format($pp_sub, 0,",",".") }}
                            </td>
                            <td class="content-menu" style="text-align: right;">
                                {{ number_format($subTotalPpn, 0,",",".") }}
                            </td>
                            <!-- <td></td> -->
                        </tr>
                    <?php endforeach ?>
                <?php endforeach ?>
            </tbody>

        </table>
        </div>
    </div>
    <!-- /.box -->
    </section>
@stop

