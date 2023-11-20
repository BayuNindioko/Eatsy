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
                    <h1>Edit Item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('items') }}">Item</a></li>
                        <li class="breadcrumb-item active">Edit Item</li>
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
                        <form action="{{ route('items_process/', $data['id']) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="name" name="name"
                                        placeholder="Input Item Name" value="{{ $data['name'] }}" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Description <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="deskripsi" name="deskripsi"
                                        placeholder="Input Item Description" value="{{ $data['deskripsi'] }}"
                                        maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>

                                {{-- <img width="300px" name="file" id="itemImage" src="{{ $data['foto'] }}">

                                <div class="form-group">
                                    <label for="file">File input</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="file" required
                                            onchange="previewImage(this);" />
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <label for="price">Price <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control " id="price" name="price"
                                        placeholder="Input Item Price" value="{{ $data['price'] }}" maxlength="255">
                                    <small>Maximal 255 characters</small>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <select name="status" class="custom-select" id="status">
                                            <option selected="selected" value="{{ $data['status'] }}">
                                                {{ $data['status'] }}</option>
                                            <option value="Ready" selected="">Ready</option>
                                            <option value="Kosong">Kosong</option>
                                        </select>
                                    </div>
                                </div>

                                @php
                                $selectedCategoryIds = collect($data['categories'])->pluck('id')->toArray();
                                @endphp
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_ids[]" class="select2" multiple="multiple"
                                        data-placeholder="Select a Category" style="width: 100%;">
                                        @foreach($selectedCategoryIds as $selectedCategoryId)
                                        @php
                                        $selectedCategory = collect($data['categories'])->firstWhere('id',
                                        $selectedCategoryId);
                                        @endphp
                                        <option value="{{ $selectedCategory['id'] }}" selected>{{
                                            $selectedCategory['name'] }}</option>
                                        @endforeach
                                        @foreach($dataCat as $category)
                                        @unless(in_array($category['id'], $selectedCategoryIds))
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endunless
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('Yakin ingin memperbarui tabel ini?')">Submit</button>
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
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#itemImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>
@endsection
