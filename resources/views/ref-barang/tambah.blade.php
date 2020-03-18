@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tambah Data Barang
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
                <!-- <h3 class="box-title">Form Tambah Barang</h3> -->
                <p><a href="{{ url('ref-barang/index') }}" class="btn btn-flat btn-primary" title="Lihat Data Barang"><i class="fa fa-list"></i> Lihat Data</a></p>
            </div>

            <div class="box-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>{{ $message }}</strong>
                  </div>
                @endif

                <form>
                    {{ csrf_field() }}

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Barcode</label>
                            <input type="text" name="kode_barcode" id="kode_barcode_barang" autocomplete="off" class="form-control" autofocus="">
                        </div>

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $data)
                                <option value="{{ $data->id }}"> {{ $data->kategori }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Harga Modal</label>
                            <input type="text" name="harga_beli2" class="form-control money" autocomplete="off" id="harga_beli2">
                            <input type="hidden" name="harga_beli" id="harga_beli">
                            <!-- <input type="text" name="harga_beli" autocomplete="off" class="form-control"> -->
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Harga Jual</label>
                            <input type="text" name="harga_jual2" class="form-control money" autocomplete="off" id="harga_jual2">
                            <input type="hidden" name="harga_jual" id="harga_jual">
                        </div>

                        <div class="form-group">
                            <label for="">Harga Nego</label>
                            <input type="text" name="harga_nego2" class="form-control money" autocomplete="off" id="harga_nego2">
                            <input type="hidden" name="harga_nego" id="harga_nego">
                        </div>

                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="text" name="stok" id="stok" autocomplete="off" class="form-control">
                        </div>

                        <button type="button" class="btn btn-flat btn-primary" id="btnSave"><i class="fa fa-save"></i> Simpan</button>
                        <a href="{{ url('ref-barang/index') }}" type="button" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->

    </section>
@endsection

@push('scripts')
<script>

$('#kode_barcode_barang').change(function() {

    $('#nama_barang').focus();
    
});

$(document).on('click', '#btnSave', function(e){
    e.preventDefault();

    var kode_barcode        = $('#kode_barcode_barang').val();
    var nama_barang         = $('#nama_barang').val();
    var kategori            = $('#kategori').val();
    var harga_beli          = $('#harga_beli').val();
    var harga_jual          = $('#harga_jual').val();
    var harga_nego  = $('#harga_nego').val();
    var stok                = $('#stok').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: 'create',
        data: {'kode_barcode' : kode_barcode, 'nama_barang' : nama_barang, 'kategori' : kategori, 'harga_beli' : harga_beli, 'harga_jual' : harga_jual, 'harga_nego' : harga_nego, 'stok' : stok},
        success: function (data) {
            if (data == 1) {
                alert('Maaf, Kode Barcode sudah tersedia!');
                window.location.href = "tambah";
            }
            else {
                alert('Sukses menambah Barang');
                window.location.href = "tambah";
            }
            
        },
    });
});

$('#harga_beli2').blur(function() {
    var harga_beli2 = $('#harga_beli2').val();
    var harga_beli = harga_beli2.split(".").join("");

    $('#harga_beli').val(harga_beli);
});

$('#harga_jual2').blur(function() {
    var harga_jual2 = $('#harga_jual2').val();
    var harga_jual = harga_jual2.split(".").join("");

    $('#harga_jual').val(harga_jual);
});

$('#harga_nego2').blur(function() {
    var harga_nego2 = $('#harga_nego2').val();
    var harga_nego = harga_nego2.split(".").join("");

    $('#harga_nego').val(harga_nego);
});

</script>
@endpush