<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BARD Order</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/auth.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <span>Kode Pin Anda :</span>
            </div>
            <div class="w-100"></div>
            <div class="col text-center">
                <h1>{{ $data['pin'] }}</h1>
            </div>
            <div class="w-100"></div>
            <div class="col text-center">
                    <a href="{{ route('homepage/', $data['table_id']) }}" id=addButton class="btn btn-success">Masuk</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
