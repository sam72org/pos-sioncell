@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1>
            Ubah Data Barang
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
                <p><a href="{{ url('ref-barang/index') }}" class="btn btn-flat btn-primary" title="Lihat Data Barang"><i class="fa fa-list"></i> Lihat Data</a></p>
        </div>

        <div class="box-body">
            <form action="{{ url('ref-barang/update').'/'.$model->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="form-group">
                    <label for="">Barcode</label>
                    <input type="text" name="kode_barcode" value="{{ $model->kode_barcode }}" autocomplete="off" class="form-control">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $data)
                            <option value="{{ $data->id }}" {{$selectedKategori == $data->id ? 'selected' : ''}} > {{ $data->kategori }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" name="nama_barang" value="{{ $model->nama_barang }}" autocomplete="off" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Harga Modal</label>
                    <input type="text" name="harga_beli2" value="{{ $model->harga_beli }}" class="form-control money" autocomplete="off" id="harga_beli2">
                    <input type="hidden" name="harga_beli" value="{{ $model->harga_beli }}" id="harga_beli">
                </div>

                <div class="form-group">
                    <label for="">Harga Jual</label>
                    <input type="text" name="harga_jual2" value="{{ $model->harga_jual }}" class="form-control money" autocomplete="off" id="harga_jual2">
                    <input type="hidden" name="harga_jual" value="{{ $model->harga_jual }}" id="harga_jual">
                </div>

                <div class="form-group">
                    <label for="">Harga Nego</label>
                    <input type="text" name="harga_nego2" value="{{ $model->harga_nego }}" class="form-control money" autocomplete="off" id="harga_nego2">
                    <input type="hidden" name="harga_nego" value="{{ $model->harga_nego }}" id="harga_nego">
                </div>

                <div class="form-group">
                    <label for="">Stok</label>
                    <input type="text" name="stok" value="{{ $model->stok }}" autocomplete="off" class="form-control">
                </div>

                <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="{{ url('ref-barang/index') }}" type="button" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
            </form>
        </div>
      </div>
      <!-- /.box -->

    </section>
@endsection

@push('scripts')
<script>

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