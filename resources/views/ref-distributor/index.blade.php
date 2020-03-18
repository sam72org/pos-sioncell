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
            <p><a href="{{ url('ref-distributor/tambah') }}" class="btn btn-flat btn-primary" title="Tambah Data Distributor"><i class="fa fa-plus"></i> Tambah Baru</a></p>
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
                        <th style="text-align: center;">Distributor</th>
                        <th style="text-align: center;">Alamat</th>
                        <th style="text-align: center;">No HP</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($model as $value): ?>
                        <tr>
                            <td style="text-align: center; width: 5%">{{ $no++ }}</td>
                            <td style="width: 25%;">{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td style="text-align: center; width: 12%">{{ $value->no_hp }}</td>
                            <td style="text-align: center; width: 12%">
                                <a href ="{{ url('ref-distributor/ubah').'/'.$value->id }}" class="btn btn-xs btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> Ubah</a>
                                <!-- <a href ="{{ url('ref-distributor/hapus').'/'.$value->id }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a> -->
                            </td>
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