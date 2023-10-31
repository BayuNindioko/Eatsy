@extends('navbar.navbar')

@section('additional-css')
    <link rel="stylesheet" href="{{ asset('css/historypage/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cartpage/empty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detailpage/plusMinus.css') }}">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Pesanan yang Diproses</h2>
            </div>
            <div class="w-100"></div>
            @php
                $count = 0;
            @endphp
            @foreach ($data[0]['order_items'] as $item)
                @if ($item['quantity_order'] != $item['quantity_delivered'])
                    <div class="col">
                        {{-- List Cart --}}
                        <div class="card dark">
                            <img src="{{ $item['item']['foto'] }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="text-section">
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                    <p class="card-text">{{ $item['notes'] }}</p>
                                    <span>Qty : {{ $item['quantity_order'] }}</span>
                                    <div class="row">
                                        <div class="col">
                                            <h5>@formatPrice($item['price'])</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $count++;
                    @endphp
                @endif
            @endforeach
        </div>
    </div>

    {{-- For Empty Page --}}
    @if ($count === 0)
        @include('historypage.emptyhistorypage')
    @endif
@endsection

@section('additional-js')
    <script src="{{ asset('js/plusMinus/plusMinus.js') }}"></script>
@endsection
