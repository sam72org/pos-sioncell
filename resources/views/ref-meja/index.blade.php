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
            <p><a href="ref-meja/tambah" class="btn btn-flat btn-primary">Create New Table</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json">
                <thead>
                    <tr>
                        <th style="text-align: center;">Nama Meja</th>
                        <th style="text-align: center;">Created At</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($model as $value): ?>
                    <tr>
                        <td>{{ $value->meja }}</td>
                        <td style="text-align: center;">{{ $value->created_at }}</td>
                        <td style="text-align: center;">
                            <a href ="ref-meja/ubah/{{ $value->id }}" class="btn btn-small btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> </a>
                            <a href ="ref-meja/hapus/{{ $value->id }}" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box -->
    </section>
@endsection


@push('scripts')
<script>
$(document).ready(function() {
    $('.tabel-json').DataTable();
});
</script>
@endpush