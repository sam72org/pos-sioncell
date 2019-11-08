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
                <h3 class="box-title">Form Tambah Barang</h3>
            </div>

            <div class="box-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ url('ref-barang/create') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $data)
                            <option value="{{ $data->id }}"> {{ $data->kategori }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama_barang" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Harga Beli</label>
                        <input type="text" name="harga_beli" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="text" name="stok" autocomplete="off" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ url('ref-barang/index') }}" type="button" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
                </form>
            </div>
        </div>
        <!-- /.box -->

    </section>
@endsection