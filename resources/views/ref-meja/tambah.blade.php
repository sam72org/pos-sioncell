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
                <h3 class="box-title">Title</h3>
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

                <form action="/ref-meja/create" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">Nama Meja</label>
                        <input type="text" name="meja" autocomplete="off" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.box -->

    </section>
@endsection