@extends('navbar.navbar')

@section('additional-css')
    <link rel="stylesheet" href="{{ asset('css/cartpage/style.css') }}">
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
            <div id="cartList">
                @php
                    $cartItems = Session::get('cartItems', []);
                    $total = 0;
                @endphp

                @if (empty($cartItems))
                    @include('cartpage.emptycartpage') {{-- Include the emptycartpage when cart is empty --}}
                @else
                    @foreach ($cartItems as $item)
                        <div class="col">
                            {{-- List Cart --}}
                            <div class="card dark">
                                <img src="{{ $item['foto'] }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="text-section">
                                        <h5 class="card-title">{{ $item['name'] }}</h5>
                                        <p class="card-text">{{ $item['catatan'] }}</p>
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="harga">@formatPrice($item['price'])</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta-section">
                                        <div>
                                            <form action="{{ route('cart/remove/', ['id' => $item['id']]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-button">
                                                    <i class="fa fa-trash-o delete-icon"
                                                        data-item-id="{{ $item['id'] }}"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div id="plusminus-container" class="qty mt-5 mt-auto">
                                            <span class="minus">-</span>
                                            <input type="number" class="count" name="qty"
                                                data-item-id="{{ $item['id'] }}" value="{{ $item['qty'] }}">
                                            <span class="plus">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $subtotal = $item['qty'] * $item['price'];
                            $total += $subtotal;
                        @endphp
                    @endforeach
                @endif
            </div>


            {{-- Confirm Section --}}
            <div class="container">
                <div class="row confirm-section">
                    <div class="col">
                        <h5>Total @formatPrice($total)</h5>
                    </div>
                    <div class="col">
                        <a id=addButton type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleConfirm">Pesan</a>

                        {{-- Modal Confirm --}}
                        <div class="modal fade" id="exampleConfirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                            data-bs-backdrop="static" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="border: none;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="confirm" src="../assets/img/emptypage/confirm.svg" class="img-popup"
                                            alt="Checklist">
                                        <div class="image-caption22">Apakah Kamu Ingin Memesannya?</div>
                                        <form action="{{ route('submit-order') }}" method="post">
                                            @csrf
                                            <button id="addButton" type="submit" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Ya, Pesan Sekarang</button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Process-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            data-bs-backdrop="static" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img src="../assets/img/emptypage/checklist.svg" class="img-popup" alt="Checklist">
                                        <div class="image-caption">Pesanan diproses</div>
                                        <div class="image-caption2">Silahkan Tunggu Pesanan Anda</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @section('additional-js')
            <script src="{{ asset('js/plusMinus/plusMinus.js') }}"></script>
            <script>
                // Fungsi untuk mengirimkan permintaan Ajax saat quantity berubah
                function updateCartItemQty(itemId, newQty) {
                    $.ajax({
                        url: "/cart/update/" + itemId, // Sesuaikan dengan URI yang benar
                        type: "PUT",
                        data: {
                            qty: newQty
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Tambahkan token CSRF
                        },
                        success: function(response) {
                            // Proses respon jika diperlukan
                            // Contoh: Tampilkan notifikasi, perbarui tampilan, dll.
                        },
                        error: function(error) {
                            // Tangani error jika diperlukan
                        }
                    });
                }

                // Merekam perubahan pada input quantity
                $('.count').on('change', function() {
                    var itemId = $(this).data('item-id');
                    var newQty = $(this).val();
                    updateCartItemQty(itemId, newQty);
                });
            </script>
        @endsection
