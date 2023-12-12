<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Barcode</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('assets/img/bg_home.jpg');
            /* Ganti dengan URL gambar latar belakang restoran */
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            height: 100vh; /* Menggunakan tinggi layar (viewport height) */
        }

        .message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 400px;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }

        @media only screen and (max-width: 600px) {

            /* Styles for screens smaller than 600px */
            .message {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="message">
        <h1>Silakan scan barcode yang tersedia di meja</h1>
    </div>
</body>

</html>
