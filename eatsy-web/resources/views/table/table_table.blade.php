@extends('homecms/sidebar')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tabel Meja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tabel Meja</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row justify-content-md-end pr-4 pt-4">
                            <a href="{{ route('create_table') }}">
                                <button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>
                                    Tambah Baru</button>
                            </a>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Tabel Meja</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Meja</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($data as $table)
                                    <tr>
                                        <td>
                                            <?php echo $no++; ?>
                                        </td>
                                        <td>{{ $table['number'] }}</td>
                                        <td>{{ $table['status'] }}</td>
                                        <td>
                                            <?php
                                                if($table['status'] == 'Kosong'){
                                            ?>
                                                <a class="btn btn-info btn-sm" href="{{ route('tables/', $table['id']) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('tables/delete/', $table['id']) }}"
                                                    onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </a>
                                            <?php }else{ ?>
                                                <a class="btn btn-info btn-sm disabled" href="{{ route('tables/', $table['id']) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm disabled"
                                                    href="{{ route('tables/delete/', $table['id']) }}"
                                                    onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2023 <a href="">La Maison</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection
