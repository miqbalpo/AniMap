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
            background: linear-gradient(180deg, rgba(28,142,219,1) 50%, rgba(27,38,44,1) 100%);
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
            width: 45vw;
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
        #account-details h2{
            width: 20vw;
        }
        #account-details h5{
            width: 25vw;
        }
        #account-details button, #statistics-section .btn{
            width: max-content;
            background-color: #2CCCFF;
            color: white;
            font-weight: 500;
            border: none;
        }
        #account-details a{
            text-decoration: none;
            color: white;
            font-weight: 600;
        }
        #statistics-section .btn{
            margin-top: -100px;
            margin-left: 80vw;
        }

    </style>
</head>
<body class="mx-auto text-white">
    <x-navbar></x-navbar>
    <main class="mx-auto">
        {{ $slot }}
    </main>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Number of Animes", { role: "style" } ],
            ["Liked", 50, "#2CCCFF"],
            ["Plan to Watch", 40, "#57F000"],
            ["Currently Watching", 30, "#FBE83A"],
            ["Disliked", 20, "color: #FFB302"],
            ["Won't Watch", 10, "color: #FE3839"],
          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

        var options = {
            //title: 'Chess opening moves',
            width: 960,
            height: 500,
            backgroundColor: 'transparent',
            legend: { position: 'none' },
            // chart: {
            // title: 'Chess opening moves',
            // subtitle: 'popularity by percentage'
            // },
            bars: 'horizontal',
            axes: {
            x: {
                0: {
                side: 'top',
                label: 'Percentage',
                textStyle: {
                    color: '#FFFFFF',
                    fontName:'Poppins' }
                }
            }
            },
            bar: { groupWidth: "50%" },
            hAxis: {
                textStyle: {
                    color: '#FFFFFF',
                    fontName:'Poppins' },
            },
            vAxis: {
                textStyle: {
                    color: '#FFFFFF',
                    fontName:'Poppins' },
            },
            titleTextStyle: {
                color: '#FFFFFF',
                fontName:'Poppins',
                fontSize: 18
            },
        };


          var chart = new google.visualization.BarChart(document.getElementById("statistics_chart"));
          chart.draw(view, options);
      }
      </script>
</body>
</html>

