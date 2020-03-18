@extends('layouts.app')

@section('content')

    <style type="text/css">
        .table-bordered {
            border : 1px solid #d1d1d1;
        }
        .table-bordered > tbody > tr > td {
            border : 1px solid #d1d1d1;
        }
        .table-bordered > thead > tr > th {
            border : 1px solid #d1d1d1;
        }
    </style>
    
    <section class="content-header">
        <h1>
            Data Kategori
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
            <?php if (auth()->user()->role == 'admin'): ?>
                <p><a href="{{ url('ref-kategori/tambah') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a></p>
            <?php endif ?>
        </div>

        <div class="box-body">
            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
              </div>
            @endif
            <table class="table table-bordered table-striped tabel-json">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama Kategori</th>
                        <?= auth()->user()->role == 'admin' ? '<th style="text-align: center;">Aksi</th>' : '' ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($model as $value): ?>
                        <tr>
                            <td style="text-align: center; width: 5%">{{ $no++ }}</td>
                            <td>{{ $value->kategori }}</td>
                            <?php if (auth()->user()->role == 'admin'): ?>
                                <td style="text-align: center;">
                                    <a href ="{{ url('ref-kategori/ubah').'/'.$value->id }}" class="btn btn-xs btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> Ubah</a>
                                    <!-- <a href ="{{ url('ref-kategori/hapus').'/'.$value->id }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a> -->
                                </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box -->
    </section>
@stop

@push('scripts')
<script>
$(document).ready(function() {
    $('.tabel-json').DataTable();
});
</script>
@endpush