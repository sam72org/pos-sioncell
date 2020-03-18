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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <section class="content-header">
        <h1>
            Pembelian Baru
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Pembelian Barang</a></li>
            <li class="active">Pembelian Baru</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="form-horizontal" id="form-add">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="distributor" id="distributor_id" class="form-control">
                                                <option value="0">Pilih Distributor</option>
                                                @foreach ($distributors as $distributor)
                                                <option value="{{ $distributor->id }}">{{ $distributor->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input type="hidden" name="id" id="barang_id">

                                            <input type="text" class="form-control" id="nama_barang" placeholder="Pilih Barang" readonly="readonly">

                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalBarang"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Qty</label>
                                        <div class="col-md-7">
                                            <input type="number" min="1" max="999" name="qty" class="form-control" id="qty">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Harga</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control money" autocomplete="off" id="harga_beli2">

                                            <input type="hidden" id="harga_beli">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-block btn-md btn-flat bg-olive" id="btnAddListPembelian" style="padding-left: 8px;"><i class="fa fa-cart-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="box-body">
                        <div id="table-list-pembelian">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; width: 15%;">Barcode</th>
                                        <th style="text-align: center;">Nama Barang</th>
                                        <th style="text-align: center; width: 12%;">Harga</th>
                                        <th style="text-align: center; width: 7%;">Qty</th>
                                        <th style="text-align: center; width: 12%;">Sub Total</th>
                                        <th style="text-align: center; width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php
                                    
                                        $total = 0;
                                        if (isset($session_order)) :
                                            // print_r($session_order);
                                            foreach ($session_order as $key => $value) :
                                                $data = DB::table('ref_barang')->where('id', $value['id'])->first();
                                                $subtotal = $value['harga'] * $value['qty'];
                                                $total += $subtotal;
                                            ?>
                                            <tr>
                                                <td style="text-align: center; width: 15%;">{{ $data->kode_barcode }}</td>
                                                <td>{{ $data->nama_barang }}</td>
                                                <td style="text-align: right; width: 12%">{{ number_format($value['harga'],0,",",".") }}</td>
                                                <td style="text-align: center; width: 7%;">{{ $value['qty'] }}</td>
                                                <td style="text-align: right; width: 12%;">{{ number_format($subtotal,0,",",".") }}</td> 
                                                <td id="tbody" style="text-align: center; width: 10%;">
                                                    <button class="btn btn-xs btn-danger btnDeleteListPembelian" data-id="<?= $data->id ?>" title="Hapus"><i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach ;
                                        endif ;
                                    ?>
                                </tbody>
                            </table>
                            <table class="table">
                                <tr style="background-color: #666; color: #fff; font-size: 20px;">
                                    <input type="text" hidden="true" id="total" value="{{ $total }}">
                                    <td><b>TOTAL</b></td>
                                    <td><b class="pull-right"><?= number_format($total,0,",",".") ?></b></td>
                                </tr>
                            </table>
                            <!-- <h3 style=" margin-right: 20px;">
                                <input type="text" hidden="true" id="total" value="">
                                <b class="pull-right"></b>
                                <span><b>Total</b></span>
                            </h3> -->
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-flat btn-primary pull-right" id="btnSavePembelian" style="margin-right: -10px; margin-bottom: 10px;"><i class="fa fa-save"></i> Simpan Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="modal fade" id="modalBarang"  tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">Daftar Barang</h4>
                </div>
                <div class="modal-body" id="modal-body">
                    <table class="table table-bordered table-stripped tabel-json">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Nama Barang</th>
                                <th style="text-align: center;">Stok</th>
                                <th style="text-align: center;">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach(\App\RefBarang::orderBy('nama_barang', 'ASC')->get() as $data): ?>
                            <tr>
                                <td>{{ $data->kode_barcode }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td style="text-align: center;">
                                    {{ $data->stok }}
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-xs btn-success btn-pilih-pembelian" data-id="{{ $data->id }}" data-barang="{{ $data->nama_barang }}" title="Pilih">
                                        <i class="fa fa-hand-pointer-o"></i> Pilih
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
 
@endsection


@push('scripts')
<script>

$(document).ready(function() {
    $('.tabel-json').DataTable();
});

</script>
@endpush