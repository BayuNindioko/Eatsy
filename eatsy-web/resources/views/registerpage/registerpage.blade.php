<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Maison</title>

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
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div class="text-end">
                    <img src="../assets/img/logo.svg" alt="Logo">
                </div>
            </div>
            <div class="col">
                <div class="bard-order-container">
                    <h2 class="bard-text">La</h2>
                    <h2 class="order-text">Maison</h2>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <form method="POST" action="{{ route('register-process/', $data['id']) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Masukkan Nama Anda</label>
                        <input name="name" type="text" class="form-control" id="exampleInputName1"
                            aria-describedby="nameHelp">
                    </div>
                    <div class="w-100"></div>
                    <div class="col text-center">
                        <button type="submit" id=addButton class="btn btn-success">Masuk</button>
                    </div>
                </form>
            </div>

        </div>

        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/pincode/pincode.js') }}"></script>
</body>

</html>
