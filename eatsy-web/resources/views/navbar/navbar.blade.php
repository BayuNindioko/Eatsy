<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LA Maison</title>
    <link rel="icon" href="../assets/img/logo.svg" type="image/svg+xml">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @yield('additional-css')
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/logo.svg" class="d-inline-block align-top" alt="">
            </a>
            <a class="navbar-brand mx-auto" href="#">
                <span id=resto>BARD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <div class="d-flex align-items-center">
                        <img src="../assets/img/logo.svg" alt="BARD Icon" width="40" height="40" class="me-2">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">BARD</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('homepage/',$dataTable['table_id']) }}"><i
                                    class="fas fa-home me-1"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('homepage/',$dataTable['table_id']) }}"><i class="fas fa-book-open me-1"></i>Menu Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('historypage/', $dataTable['table_id']) }}"><i
                                    class="fas fa-history me-1"></i>Riwayat Saya</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="content-body">
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('additional-js')
</body>

</html>
