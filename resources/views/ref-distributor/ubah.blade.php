@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1>
            Ubah Data Distributor
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
                <p><a href="{{ url('ref-distributor/index') }}" class="btn btn-flat btn-primary" title="Lihat Data Distributor"><i class="fa fa-list"></i> Lihat Data</a></p>
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

                <form action="{{ url('ref-distributor/update').'/'.$model->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-group">
                        <label for="">Nama Distributor</label>
                        <input type="text" name="nama" value="{{ $model->nama }}" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $model->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">No Hp</label>
                        <input type="text" name="no_hp" value="{{ $model->no_hp }}" autocomplete="off" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ url('ref-distributor/index') }}" type="button" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
                </form>
            </div>
        </div>
        <!-- /.box -->

    </section>
@endsection