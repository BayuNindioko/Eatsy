@extends('homecms/sidebar')

@section('content')
<style>
    .select2-container .select2-selection .select2-selection__choice {
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
    }

    .select2-container .select2-selection .select2-selection__choice:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>
<div class="content-wrapper" style="min-height: 541px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('items') }}">Item</a></li>
                        <li class="breadcrumb-item active">Tambah Item</li>
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
                        <form id="create-item-form" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="name" name="name"
                                        placeholder="Input Item Name" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Description <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="deskripsi" name="deskripsi"
                                        placeholder="Input Item Description" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>

                                <div class="form-group">
                                    <label for="file">File input</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="file" required />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="price">Price <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="price" name="price"
                                        placeholder="Input Item Price" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <select name="status" class="custom-select" id="status">
                                            <option value="Ready" selected="">Ready</option>
                                            <option value="Kosong">Kosong</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_ids[]" class="select2" multiple="multiple"
                                        data-placeholder="Select a Category" style="width: 100%;">
                                        @foreach($data as $cat)
                                        <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
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

</div>

<script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

</script>
<script>
    $(function() {
        $('#create-item-form').submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var url = 'https://lamaisonetc.my.id/api/items';


            var formData = new FormData(form[0]);


            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    console.log('Data berhasil dikirim:', response);
                    window.location.href = '{{ route("items") }}';
                },
                error: function(xhr, status, error) {

                    console.error('Terjadi kesalahan:', error);
                }
            });
        });

        // Initialize Select2 Elements
        $('.select2').select2();
    });
</script>

@endsection
