<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>{{ $title }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        html, body {
            margin: auto;
            overflow-x: hidden;
            background: linear-gradient(180deg, rgba(28,142,219,1) 10%, rgba(27,38,44,1) 50%);
            background-attachment: scroll;
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
        .dropdown-menu a:active{
        background-color: #2CCCFF;
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
            width: 100vw;
        }
        #characters-section #characters-list, #staff-section #staff-list{
            height: 50vh;
            overflow-y: scroll;
        }
        #characters-section img, #staff-section img{
            width: 60px;
            height: 90px;
        }
        #characters-section p, #staff-section p{
            width: 20rem;
        }
        #characters-section .characters-info, #staff-section .staff-info{
            width: 50vw;
        }
        #songs-section p{
            width: 40vw;
        }
        #videos-section{
            width: 50vw;
        }
        #account-info-section{
            width: 60vw;
        }
        #account-info-section img{
            border-radius: 5px;
            width: 160px;
            height: 240px;
        }
        #account-info-section button{
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
        #anime-list-section #anime-selection .btn{
            width: 120px;
            height: 60px;
            background-color: transparent;
            border-radius: 0;
            border-bottom: 2px solid white;
        }
        #anime-list-section #anime-selection .btn:active{
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
            width: 80px !important;
            text-align: center;
        }
        #anime-list-table img{
            max-width: 80px;
            height: 120px;
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

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script>
      new DataTable('#anime-list-table');
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(function () {
            const chartContainer = document.getElementById("statistics_chart");
            if (chartContainer) {
                drawChart();
            }
        });

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Number of Animes", { role: "style" }],
                ["Liked", 50, "#2CCCFF"],
                ["Plan to Watch", 40, "#57F000"],
                ["Currently Watching", 30, "#FBE83A"],
                ["Disliked", 20, "color: #FFB302"],
                ["Won't Watch", 10, "color: #FE3839"],
            ]);

            var options = {
                width: 960,
                height: 500,
                backgroundColor: "transparent",
                legend: { position: "none" },
                bars: "horizontal",
                axes: {
                    x: {
                        0: {
                            side: "top",
                            label: "Percentage",
                            textStyle: {
                                color: "#FFFFFF",
                                fontName: "Poppins",
                            },
                        },
                    },
                },
                bar: { groupWidth: "50%" },
                hAxis: {
                    textStyle: {
                        color: "#FFFFFF",
                        fontName: "Poppins",
                    },
                },
                vAxis: {
                    textStyle: {
                        color: "#FFFFFF",
                        fontName: "Poppins",
                    },
                },
                titleTextStyle: {
                    color: "#FFFFFF",
                    fontName: "Poppins",
                    fontSize: 18,
                },
            };

            var chart = new google.visualization.BarChart(
                document.getElementById("statistics_chart")
            );
            chart.draw(data, options);
        }
    </script>

</body>
</html>

