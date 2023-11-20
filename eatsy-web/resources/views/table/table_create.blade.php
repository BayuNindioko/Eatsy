@extends('homecms/sidebar')

@section('content')
<div class="content-wrapper" style="min-height: 541px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Table</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('tables') }}">Table</a></li>
                        <li class="breadcrumb-item active">Edit Table</li>
                    </ol>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header"></div>
                        <!-- form start -->
                        <form action="{{ route('create_table_process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="number">Number <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="number" name="number"
                                        placeholder="Input Table Number" value="" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('Yakin ingin menambah tabel ini?')">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </section>
</div>


<!-- /.content -->
</div>
@endsection
