<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LA Maison</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/pincode.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Selamat Datang!</h1>
                <h1>di LA Maison</h1>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div class="text-end">
                    <img src="../assets/img/Maison.png" alt="Logo">
                </div>
            </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <h3>Masukkan Kode PIN Anda</h3>
            </div>
            <div class="w-100"></div>
            <form action="{{ route('login-process/', $data['id']) }}" method="POST">
                @csrf
                <div class="col">
                    <input type="text" name="name" hidden value="{{$data['name']}}">
                    <input type="text" name="table_id" hidden value="{{$data['table_id']}}">
                    <div class="pin-code">
                        <input type="number" maxlength="1" class="pin-input" autofocus>
                        <input type="number" maxlength="1" class="pin-input">
                        <input type="number" maxlength="1" class="pin-input">
                        <input type="number" maxlength="1" class="pin-input">
                    </div>
                    <input type="hidden" name="pin" id="combined-pin-input">
                </div>
                <div class="w-100"></div>
                <div class="col text-center">
                    <button type="submit" id=addButton  class="btn btn-secondary">Masuk</button>
                </div>
            </form>
        </div>

        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/pincode/pincode.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const pinInputs = document.querySelectorAll(".pin-input");
                const combinedPinInput = document.getElementById("combined-pin-input");

                pinInputs.forEach(function(input) {
                    input.addEventListener("input", function() {
                        let combinedPin = "";
                        pinInputs.forEach(function(pinInput) {
                            combinedPin += pinInput.value;
                        });
                        combinedPinInput.value = combinedPin;
                    });
                });

                const form = document.querySelector("form");
                form.addEventListener("submit", function() {
                    let combinedPin = "";
                    pinInputs.forEach(function(pinInput) {
                        combinedPin += pinInput.value;
                    });
                    combinedPinInput.value = combinedPin;
                });
            });
        </script>

</body>

</html>
