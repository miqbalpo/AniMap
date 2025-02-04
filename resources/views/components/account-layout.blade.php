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
            background-color: #1B262C;
        }
        .navbar{
        width: 100%;
        position: fixed;
        top: 0;
        background-color: #1B262C;
        padding: 1rem;
    }
    .navbar .btn, .btn{
        /* position: fixed; */
        width: 100px;
        background-color: #1C8EDB;
        color: white;
        font-weight: 500;
        border: none;
    }
    a{
        text-decoration: none;
        color: white;
        font-weight: 400;
    }
    .navbar .btn:active{
        background-color: #2CCCFF;
    }
        main {
            width: 30%;
            margin-top: 10vh;
            background-color: #1B262C;
            font-family: "Poppins", serif;
            font-weight: 300;
        }
    </style>
</head>
<body class="mx-auto text-white">
    <nav class="navbar d-flex justify-content-end">
        <div>
            <button type="button" class="btn justify-content-end" onclick="location.href='{{ route('welcome') }}'">
                Search
            </button>
        </div>
    </nav>
    <main class="mx-auto">
        {{ $slot }}
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
