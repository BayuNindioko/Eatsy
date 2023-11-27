@extends('homecms/sidebar')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Laporan</h1>
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
                                <a href="{{ route('exportpdf') }}">

                                    <button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>
                                        Download PDF</button>
                                </a>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Laporan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Bulan</th>
                                            <th>Name</th>
                                            <th>Item Dipesan</th>
                                            <th>Harga Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data['salesData'] as $report)
                                            <tr>
                                                <td>
                                                    <?php echo $no++; ?>
                                                </td>
                                                <td>{{ $data['month'] }}</td>
                                                <td>{{ $report['name'] }}</td>
                                                <td>{{ $report['total_quantity'] }}</td>
                                                <td>{{ $report['total_price'] }}</td>
                                            </tr>
                                        @endforeach
                                        <td colspan="4">Total Pemasukan</td>
                                        <td>{{ $data['totalIncome'] }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Jumlah Terjual</td>
                                            <td>{{ $data['totalItemsSold'] }}</td>
                                        </tr>
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
