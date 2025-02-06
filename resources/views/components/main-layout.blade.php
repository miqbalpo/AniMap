<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>{{ $title }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        html, body {
            margin: auto;
            overflow-x: hidden;
            scroll-behavior: smooth;
            background: linear-gradient(180deg, rgba(28,142,219,1) 15%, rgba(27,38,44,1) 100%);
            background-attachment: fixed;
        }
        main {
            width: 90%;
            margin-top: 20vh;
            background-color: transparent;
            font-family: "Poppins", serif;
            font-weight: 300;
        }
        .search-bar{
            width: 50%;
        }
        .search-bar .btn{
            background-color: #1B262C;
        }
        .search-bar .btn:hover{
            background-color: #1B262C;
        }
        .search-bar .btn:active{
            background-color: #2CCCFF;
        }
        .dropdown .btn{
            background-color: #1B262C;
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
        .dropdown-menu a:active{
        background-color: #1B262C;
        }
        #search-results img{
            object-fit: cover;
        }
        #overview-section h1{
            width: 75vw;
            font-size: 3rem;
            text-wrap: wrap;
        }
        #overview-section .icon-info:first-child h5{
            /* width: 20vw; */
            font-size: 2.75rem;
        }
        #overview-section .icon-info h5{
            font-size: 1.5rem;
        }
        #info-section{
            width: max-content;
        }
        #details-section{
            background-color: #BBE1FA;
            color: black;
        }
        #synopsis-section{
            width: 50vw;
        }
        #synopsis-section p{
            text-align: justify;
        }
        #characters-section, #staff-section, #songs-section{
            width: 85vw;
        }
        #characters-section #characters-list, #staff-section #staff-list, #songs-section #op-list, #songs-section #ed-list{
            min-height: 25vh;
            max-height: 50vh;
            overflow-y: auto;
        }
        #characters-section #characters-list::-webkit-scrollbar, #staff-section #staff-list::-webkit-scrollbar, #songs-section #op-list::-webkit-scrollbar,  #songs-section #ed-list::-webkit-scrollbar{
            width: 10px;
            background: rgba(0, 0, 0, 0.25);
        }
        #characters-section #characters-list::-webkit-scrollbar-thumb, #staff-section #staff-list::-webkit-scrollbar-thumb, #songs-section #op-list::-webkit-scrollbar-thumb,  #songs-section #ed-list::-webkit-scrollbar-thumb{
            background: #BBE1FA;
        }
        #characters-section img, #staff-section img{
            width: 60px;
            height: 90px;
        }
        #characters-section .characters-info{
            width: 43vw;
        }
        #characters-section p{
            width: 10rem;
            text-wrap: wrap;
        }
        #staff-section .staff-info{
            width: 50vw;
        }
        #staff-section p{
            width: 20rem;
        }
        #songs-section{
            width: 85.75vw;
        }
        #songs-section #op-list, #songs-section #ed-list{
            width: 100vw;
            scrollbar-width: 10px;
            overflow-x: hidden;
        }
        #songs-section p{
            text-wrap: wrap;
        }
        #videos-section{
            width: 50vw;
        }
        #account-info-section, #account-edit-section{
            width: 60vw;
        }
        #account-info-section img, #account-edit-section img{
            border-radius: 5px;
            width: 160px;
            height: 240px;
        }
        #account-info-section button, #account-edit-section button{
            width: max-content;
            background-color: #2CCCFF;
            color: white;
            font-weight: 500;
            border: none;
        }
        #profile-picture img{
            object-fit: cover;
        }
        #profile-picture button{
            width: 100%;
        }
        #profile-picture .profile-pic-btn:disabled{
            visibility: hidden;
        }
        #account-details h2{
            width: 20vw;
        }
        #account-details h5{
            width: 24.5vw;
        }
        #account-details input{
            width: 25vw;
            color: white;
            background-color: transparent;
            border: 1px solid white;
        }
        #account-details input:disabled{
            width: 25vw;
            color: white;
            background-color: transparent;
            border: none;
        }
        #account-details button{
            text-decoration: none;
            color: white;
            font-weight: 600;
        }
        #statistics-section .btn{
            width: max-content;
            margin-top: -100px;
            position: absolute;
            right: 10%;
            background-color: #2CCCFF;
            color: white;
            font-weight: 500;
            border: none;
        }
        #anime-list-section #anime-selection .btn {
            width: 120px;
            height: 60px;
            background-color: transparent;
            border-radius: 0;
            border-bottom: 2px solid white;
            color: white;
            transition: background-color 0.3s;
        }

        #anime-list-section #anime-selection .btn.active {
            background-color: #2CCCFF;
        }

        #anime-list-section #anime-selection .btn:hover {
            background-color: rgba(44, 204, 255, 0.2);
        }

        #anime-list-section #anime-selection .btn:active {
            background-color: #2CCCFF;
        }
        #anime-list-table {
            border-collapse: collapse;
        }
        #anime-list-table th,
        #anime-list-table td {
            color: white;
            background-color: transparent;
            border: 1px solid transparent;
        }
        #anime-list-table th{
            height: 3rem;
            vertical-align: middle;
        }
        #anime-list-table tr td:first-child {
            width: 80px;
            text-align: center;
        }
        #anime-list-table tr td:not(:nth-child(2)){
            text-align: justify;
        }
        #anime-list-table img{
            width: 80px;
            height: 120px;
            border-radius: 5px;
        }
        #anime-list-table .btn {
            width: 120px;
            color: white;
            background-color: #2CCCFF;
            border: none;
        }

        #anime-list-table .btn:hover {
            background-color: #1C8EDB;
        }
        .page-link.active, .active>.page-link{
            background-color: #2CCCFF;
            border: #2CCCFF;
        }
        .page-link:focus{
            box-shadow: 0 0 0 .25rem rgba(44, 204, 255, .25)
        }
    </style>
</head>
<body class="mx-auto text-white">
    <x-navbar></x-navbar>
    <main class="mx-auto">
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

