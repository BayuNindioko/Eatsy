@extends('homecms/sidebar')

@section('content')
<div class="content-wrapper" style="min-height: 541px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('tables') }}">User</a></li>
                        <li class="breadcrumb-item active">Create User</li>
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
                        <form action="{{ route('create_user_process') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="name" name="name"
                                        placeholder="Input User Name" value="" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <small class="text-danger">*</small></label>
                                    <input type="email" class="form-control " id="email" name="email"
                                        placeholder="Input User Email" value="" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <small class="text-danger">*</small></label>
                                    <input type="password" class="form-control " id="password" name="password"
                                        placeholder="Input User Password" value="" maxlength="255">
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
