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
            background-color: #1C8EDB;
        }
        main {
            width: 100%;
            margin-top: 20vh;
            background: linear-gradient(180deg, rgba(28,142,219,1) 0%, rgba(27,38,44,1) 35%);
            font-family: "Poppins", serif;
            font-weight: 300;
        }
        .search-bar{
            width: 50%;
        }
        .search-bar .btn{
            background-color: #1C8EDB;
        }
        .search-bar .btn:hover{
            background-color: #1B262C;
        }
        .search-bar .btn:active{
            background-color: #2CCCFF;
        }
        .dropdown .btn{
            background-color: #1C8EDB;
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
        #overview-section h1{
            width: max-content;
            font-size: 4rem;
        }
        #overview-section .icon-info:first-child h5{
            font-size: 3rem;
        }
        #overview-section .icon-info h5{
            font-size: 1.5rem;
        }
        #info-section{
            width: 100vw;
        }
        #details-section{
            background-color: #BBE1FA;
            color: black;
        }
        #synopsis-section{
            width: 100vw;
        }
        #synopsis-section p{
            text-align: justify;
        }
        #characters-section{
            width: 100vw;
        }
        #characters-section #characters-list{
            height: 50vh;
            overflow-y: scroll;
        }
        #characters-section img{
            width: 60px;
            height: 90px;
        }
        #characters-section p{
            width: 20rem;
        }
        #characters-section .characters-info{
            width: 50vw;
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
