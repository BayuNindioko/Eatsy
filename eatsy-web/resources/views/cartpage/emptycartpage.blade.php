@extends('navbar.navbar')

@section('additional-css')
    <link rel="stylesheet" href="{{ asset('css/cartpage/empty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detailpage/plusMinus.css') }}">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Keranjangku</h2>
            </div>
        </div>

        <div class="circle-container">
            <div class="circle">
                <img src="{{ asset('assets/img/emptypage/emptycart.svg') }}" alt="emptyicon">
            </div>
            <p>Keranjang Belanja Anda Masih Kosong</p>
            <a id=addButton href="{{ route('homepage/',$dataTable['table_id']) }}" class="btn btn-warning">Pesan Sekarang</a>
        </div>
    @endsection

    @section('additional-js')
        <script src="{{ asset('js/plusMinus/plusMinus.js') }}"></script>
    @endsection
