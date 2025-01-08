<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>{{ $title }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        html, body {
            overflow-x: hidden;
            background-color: #1B262C;
        }
        main {
            width: 100%;
            margin-top: 20vh;
            background-color: #1B262C;
            font-family: "Poppins", serif;
            font-weight: 300;
        }
        .search-bar{
            width: 50%
        }
        .card {
            border: none;
            width: 240px;
        }
        .card .btn{
            width: 100%;
        }
        .card img{
            border-radius: 5px;
            width: 160px;
            height: 240px;
        }
    </style>
</head>
<body class="mx-auto text-white">
    <x-navbar></x-navbar>
    <main class="mx-auto">
        {{ $slot }}
    </main>
</body>
</html>
