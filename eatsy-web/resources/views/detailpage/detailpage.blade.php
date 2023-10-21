@extends('navbar.navbar')

@section('additional-css')
    <link rel="stylesheet" href="{{ asset('css/detailpage/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detailpage/plusMinus.css') }}">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
    {{-- Top Text and Image --}}
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Detail Menu</h2>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <img src="{{ $data['foto'] }}" class="d-block w-100" alt="..." />
            </div>
        </div>
    </div>

    {{-- Column 2 --}}
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>{{ $data['name'] }}</h3>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <p>{{ $data['deskripsi'] }}</p>
            </div>
        </div>
    </div>

    {{-- Column 3 --}}
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex align-items-center">
                    <h3 id="price">@formatPrice($data['price'])</h3>
                </div>
            </div>
            <div class="col">
                <div id="plusminus-container" class="qty mt-5 mt-auto">
                    <span class="minus">-</span>
                    <input id="qty-bro" type="number" class="count" name="qty" value="1">
                    <span class="plus">+</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Column 4 --}}
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h3>Catatan :</h3>
                    </label>
                    <textarea name="catatan" class="form-control no-resize" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <form method="POST" action="{{ route('cart/tambah/', $data['id']) }}">
                    @csrf
                    <input name="table_id" hidden type="text" value="{{ $dataTable['table_id'] }}">
                    <input id="qtyHidden" name="qty" hidden type="text" value="">
                    <input id="catatanHidden" name="catatan" hidden type="text" value="">
                    <button id="addToCartButton" class="btn btn-success">Tambahkan ke Keranjang</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additional-js')
    <script src="{{ asset('js/plusMinus/plusMinus.js') }}"></script>
    <script>
        // JavaScript to update the hidden input fields when the form is submitted
        const addToCartButton = document.getElementById('addToCartButton');
        const qtyInput = document.getElementById('qty-bro');
        const catatanTextarea = document.getElementById('exampleFormControlTextarea1');
        const qtyHiddenInput = document.getElementById('qtyHidden');
        const catatanHiddenInput = document.getElementById('catatanHidden');

        addToCartButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            // Get the values from the input and textarea
            const qtyValue = qtyInput.value;
            const catatanValue = catatanTextarea.value;

            // Update the hidden input fields with the values
            qtyHiddenInput.value = qtyValue;
            catatanHiddenInput.value = catatanValue;

            // Submit the form
            addToCartButton.closest('form').submit();
        });
    </script>
@endsection
