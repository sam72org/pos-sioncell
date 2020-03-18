@extends('layouts.app')

@section('content')
    
    <section class="content-header">
        <h1>
            Data User
            <small>{{ date('d-m-Y H:i') }} </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">Data User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <p><a href="{{ url('user/tambah') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah User Baru</a></p>
        </div>

        <div class="box-body">
            <table class="table table-bordered tabel-json">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Username</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Role</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=1; 
                    foreach ($model as $value): 
                ?>
                    <tr>
                        <td style="text-align: center; width: 5%;">{{ $no++ }}</td>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->name }}</td>
                        <td style="text-align: left;">{{ $value->email }}</td>
                        <td style="text-align: left; text-transform: capitalize;">{{ $value->role }}</td>
                        <td style="text-align: center;">
                            <a href ="{{ url('user/ubah').'/'.$value->id }}" class="btn btn-xs btn-warning" style="margin-right:5px;"><i class="fa fa-edit"></i> Edit</a>
                            <a href ="{{ url('user/ubah-password').'/'.$value->id }}" class="btn btn-xs btn-success" style="margin-right:5px;"><i class="fa fa-lock"></i> Change Password</a>
                            <!-- <a href ="{{ url('user/hapus').'/'.$value->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a> -->
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