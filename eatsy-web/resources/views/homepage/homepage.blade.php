@extends('navbar.navbar')

@section('additional-css')
<link rel="stylesheet" href="{{ asset('css/homepage/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage/btgroup.css') }}">
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
<section id=topSection>
    {{-- Welcome --}}
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-column">
                <h2 id=welcome>Selamat Datang!</h2>
                <p id=name>{{ $dataTable['name'] }}</p>
            </div>
            <div class="col d-flex align-items-end justify-content-end">
                <div class="circle">
                    <h2 id=noTable>{{ $dataTable['table_id'] }}</h2>
                </div>
            </div>
        </div>

        {{-- Promo / unggulan --}}
        <div class="row">
            <div class="col">
                <h3 id=promotions>Promo / unggulan</h3>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../assets/img/banner/ban1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/img/banner/ban2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../assets/img/banner/burger.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        {{-- Search --}}
        <div class="container">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form">
                        <i class="fa fa-search"></i>
                        <input id="myInput" onkeyup="search()" type="text" class="form-control form-input"
                            placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Button Group / Filter --}}
<ul class="nav nav-pills mb-3 horizontal-scroll flex-nowrap overflow-auto" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-semua-tab" data-bs-toggle="pill" data-bs-target="#pills-semua"
            type="button" role="tab" aria-controls="pills-semua" aria-selected="true">Semua</button>
    </li>
    @foreach ($dataCategory as $cat)
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-{{ strtolower($cat['name']) }}-tab" data-bs-toggle="pill"
            data-bs-target="#pills-{{ strtolower($cat['name']) }}" type="button" role="tab"
            aria-controls="pills-{{ strtolower($cat['name']) }}" aria-selected="false">{{ $cat['name'] }}</button>
    </li>
    @endforeach
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-semua" role="tabpanel" aria-labelledby="pills-semua-tab"
        tabindex="0">
        {{-- Cardview for all items --}}
        <div class="card-container">
            @foreach ($data as $item)
            <div class="card">
                <img src="{{ $item['foto'] }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['name'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $item['deskripsi'] }}</h6>
                    <h5 class="card-text">@formatPrice($item['price'])</h5>
                    <div style="display: flex; justify-content: center;">
                        <form id="addButtonForm" action="{{ route('detailpage') }}" method="post"
                            style="display: inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="table_id" value="{{ $dataTable['table_id'] }}">
                            <button type="submit" class="btn btn-secondary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @foreach ($dataCategory as $cat)
    <div class="tab-pane fade" id="pills-{{ strtolower($cat['name']) }}" role="tabpanel"
        aria-labelledby="pills-{{ strtolower($cat['name']) }}-tab" tabindex="0">
        {{-- Cardview for items in the category --}}
        <div class="card-container">
            @foreach ($data as $item)
            @foreach ($item['categories'] as $kategori)
            @if ($kategori['name'] === $cat['name'])
            <div class="card">
                <img src="{{ $item['foto'] }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['name'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">
                        {{ $item['deskripsi'] }}</h6>
                    <h5 class="card-text">@formatPrice($item['price'])</h5>
                    <div style="display: flex; justify-content: center;">
                        <form id="addButtonForm" action="{{ route('detailpage') }}" method="post"
                            style="display: inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="table_id" value="{{ $dataTable['table_id'] }}">
                            <button type="submit" class="btn btn-secondary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endforeach
        </div>
    </div>
    @endforeach
</div>

{{-- Floating Button --}}
<a href="{{ route('cartpage/', $dataTable['table_id']) }}" class="float">
    @php
    $cartItems = Session::get('cartItems', []);
    $total = 0;
    @endphp

    @if (empty($cartItems))
    <i class="fa fa-shopping-cart my-float" aria-hidden="true"></i>
    @else
    <i class="fa fa-shopping-cart my-float" aria-hidden="true">
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            *
            <span class="visually-hidden">unread messages</span>
        </span>
    </i>
    @endif
</a>
@endsection

<script>
    function search() {
        var input, filter;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName("card")
        titles = document.getElementsByClassName("card-title");

        for (i = 0; i < cards.length; i++) {
            a = titles[i];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
</script>
