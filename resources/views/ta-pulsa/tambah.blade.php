@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1>
            Tambah Penjualan Pulsa
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
                <!-- <h3 class="box-title">Penjualan Pulsa</h3> -->
                <p><a href="{{ url('ta-pulsa/index') }}" class="btn btn-flat btn-primary" title="Data Penjualan Pulsa"><i class="fa fa-list"></i> Lihat Data</a></p>
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

                <form action="{{ url('ta-pulsa/create') }}" method="post">
                    {{ csrf_field() }}

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required="">
                                <option value="">- Pilih Kategori -</option>
                                <option value="Pulsa Reguler">Pulsa Reguler</option>
                                <option value="Pulsa Data">Pulsa Data</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Operator</label>
                            <select name="operator" id="operator" class="form-control" required="">
                                <option value="">- Pilih Operator -</option>
                                <option value="Telkomsel">Telkomsel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal</label>
                            <input type="text" name="nominal2" id="nominal2" autocomplete="off" class="form-control money" required="">
                            <input type="hidden" name="nominal" id="nominal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No HP</label>
                            <input type="text" name="no_hp" autocomplete="off" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="harga2" id="harga2" autocomplete="off" class="form-control money" required="">
                            <input type="hidden" name="harga" id="harga">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-flat btn-primary" id="btnSimpan"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ url('ta-pulsa/index') }}" type="button" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->

    </section>
@endsection

@push('scripts')
<script>

$('#harga2').blur(function() {
    var harga = $('#harga2').val();
    var harga2 = harga.split(".").join("");

    $('#harga').val(harga2);
    
});

$('#nominal2').blur(function() {
    var nominal = $('#nominal2').val();
    var nominal2 = nominal.split(".").join("");

    $('#nominal').val(nominal2);
    
});
</script>
@endpush
