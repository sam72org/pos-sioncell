@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1>
            Ubah Data Pelanggan
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index">Pelanggan</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Form Ubah Pelanggan</h3>
            </div>

            <div class="box-body">
                <form action="{{ url('ref-pelanggan/update').'/'.$model->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" value="{{ $model->nama }}" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" value="{{ $model->alamat }}" autocomplete="off" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">No HP</label>
                        <input type="text" name="no_hp" value="{{ $model->no_hp }}" autocomplete="off" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ url('ref-pelanggan/index') }}" type="button" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
                </form>
            </div>
        </div>
        <!-- /.box -->

    </section>
@endsection