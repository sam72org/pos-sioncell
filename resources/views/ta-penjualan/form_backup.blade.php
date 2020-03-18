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
            Point Of Sales
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Penjualan</a></li>
            <li class="active">Point Of Sales</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form class="form-horizontal" id="form-add">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="hidden" name="no_penjualan" id="no_penjualan" value="{{ $no_penjualan }}">
                                        <input type="hidden" id="barang_id">
                                        <input type="hidden" id="stok">
                                        <input type="hidden" id="harga_beli">

                                        <input type="text" id="kode_barcode" class="form-control" autofocus="" placeholder="Scan Barcode Disini...">
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalBarang"><i class="fa fa-search"></i></button>
                                        </span>
                                        
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label class="col-md-2 control-label">Nama Barang</label> -->
                                        <div class="col-md-12">
                                            <input type="text" id="nm_barang" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Harga</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control money" autocomplete="off" id="harga_jual2">
                                            <input type="hidden" id="harga_jual">
                                            <input type="hidden" id="harga_nego">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Qty</label>
                                        <div class="col-md-9">
                                            <input type="number" min="1" max="999" name="qty" class="form-control" id="qty">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-block btn-md btn-flat bg-olive" id="btnAddListPenjualan" style="padding-left: 8px;"><i class="fa fa-cart-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="box-body">
                        <div id="table-list-penjualan">
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
                                                $data       = DB::table('ref_barang')->where('id', $value['id'])->first();
                                                $subtotal   = $value['harga'] * $value['qty'];
                                                $total += $subtotal;
                                            ?>
                                            <tr>
                                                <td style="text-align: center; width: 15%;">{{ $data->kode_barcode }}</td>
                                                <td style="text-align: left;">{{ $data->nama_barang }}</td>
                                                <td style="text-align: right; width: 12%;">
                                                    <input type="text" name="" value="{{ number_format($value['harga'],0,',','.') }}" class="form-control">
                                                </td>
                                                <td style="text-align: center; width: 7%;">{{ $value['qty'] }}</td>
                                                <td style="text-align: right; width: 12%;">{{ number_format($subtotal,0,",",".") }}</td> 
                                                <td id="tbody" style="text-align: center; width: 10%;">
                                                    <button class="btn btn-sm btn-success btnTambahQtyListPenjualan" data-id="<?= $data->id ?>" title="Tambah"><i class="fa fa-plus"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning btnKurangQtyListPenjualan" data-id="<?= $data->id ?>" title="Kurang"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger btnDeleteListPenjualan" data-id="<?= $data->id ?>" title="Hapus"><i class="fa fa-trash"></i>
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
                                <span><b>TOTAL</b></span>
                            </h3> -->
                            
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-flat btn-primary pull-right" id="btnSavePenjualan" style="margin-right: -10px; margin-bottom: 10px;"><i class="fa fa-save"></i> Proses Transaksi</button>
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
                    <h4 class="modal-title" id="modal-title">DAFTAR BARANG</h4>
                </div>
                <div class="modal-body" id="modal-body">
                    <table class="table table-bordered table-striped tabel-json">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Barcode</th>
                                <th style="text-align: center;">Nama Barang</th>
                                <th style="text-align: center;">Stok</th>
                                <th style="text-align: center;">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach(\App\RefBarang::orderBy('nama_barang', 'DESC')->get() as $data): ?>
                            <tr>
                                <td style="text-align: center;">{{ $data->kode_barcode }}</td>
                                <td style="text-align: left;">{{ $data->nama_barang }}</td>
                                <td style="text-align: center;">{{ $data->stok }}</td>
                                <td style="text-align: center;">
                                    <?php if ($data->stok <= 0): ?>

                                    <?php else: ?>
                                        <button class="btn btn-sm btn-success btn-pilih-penjualan" data-id="{{ $data->id }}" data-barcode="{{ $data->kode_barcode }}" data-barang="{{ $data->nama_barang }}" data-beli="{{ $data->harga_beli }}" data-jual="{{ $data->harga_jual }}" data-nego="{{ $data->harga_jual_minimum }}" data-stok="{{ $data->stok }}" title="Pilih">
                                        <i class="fa fa-hand-pointer-o"></i> Pilih
                                        </button>
                                    <?php endif ?>
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

    <div class="modal fade" id="modalStruk"  tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"><i class="fa fa-info"></i> PRINT STRUK</h4>
                </div>
                <div class="modal-body" id="modal-body">
                    <h4>PRINT STRUK PENJUALAN ?</h4>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button class="btn btn-primary" id="btnPrintPenjualan" data-id="{{ $no_penjualan }}" title="Print"><i class="fa fa-print"></i> Print Struk</button>
                    <a href="{{ url('ta-penjualan/new-transaction') }}" class="btn btn-danger"><i class="fa fa-close"></i> Tidak</a>
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