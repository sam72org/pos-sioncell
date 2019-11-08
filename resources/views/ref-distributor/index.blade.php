@extends('layouts.app')

@section('content')
    
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
            <p><a href="{{ url('ref-distributor/tambah') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Distributor Baru</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama Distributor</th>
                        <th style="text-align: center;">Alamat</th>
                        <th style="text-align: center;">No HP</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($model as $value): ?>
                        <tr>
                            <td style="text-align: center; width: 5%">{{ $no++ }}</td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td style="text-align: center;">{{ $value->no_hp }}</td>
                            <td style="text-align: center;">
                                <a href ="{{ url('ref-distributor/ubah').'/'.$value->id }}" class="btn btn-sm btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> </a>
                                <a href ="{{ url('ref-distributor/hapus').'/'.$value->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
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