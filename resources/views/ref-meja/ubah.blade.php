@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1>
            Point Of Sales
            <small>it all starts here</small>
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
            <h3 class="box-title">Ubah Data #{{ $model->kode }}</h3>
        </div>

        <div class="box-body">
            <form action="/ref-meja/edit/{{ $model->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="form-group">
                    <label for="">Nama Menu</label>
                    <input type="text" name="meja" value="{{ $model->meja }}" autocomplete="off" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <a href="/ref-meja" class="btn btn-flat btn-danger"><i class="fa fa-close"></i> Batal</a>
            </form>
        </div>
      </div>
      <!-- /.box -->

    </section>
@endsection