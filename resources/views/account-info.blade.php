@php
    $profile_pic = Auth::user()-> profile_pic;
    $username = Auth::user()-> name;
    $email = Auth::user()-> email;
    $created_at = Auth::user()->created_at->format('d F Y');

    $liked = $statusCounts['liked'];
    $plan_to_watch = $statusCounts['plan_to_watch'];
    $currently_watching = $statusCounts['currently_watching'];
    $disliked = $statusCounts['disliked'];
    $wont_watch = $statusCounts['wont_watch'];

    //dd($statusCounts);
@endphp

<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-layout></x-search-layout>
    <div class="bg-transparent mx-auto text-white">
        <div id="account-info-section" class="mx-auto mb-5">
            <h1 class="mb-4 fw-semibold text-center">Account Information</h1>
            <div class="d-flex bg-transparent">
                <div id="profile-picture" class="mb-3">
                    @if ( $profile_pic == null)
                        <img src="{{ asset('image/placeholder_pfp.png')}}"class="card-img-top" alt="...">
                    @else
                        <img src="/{{ $profile_pic }}" alt="" class="card-img-top" alt="...">
                    @endif
                </div>
                <div id="account-details" class="text-start">
                    <div class="d-flex mb-4 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Username</h2>
                        <input type="text" class="fs-5 fw-medium my-auto text-end form-control" placeholder="username" aria-label="Username" aria-describedby="basic-addon1" value="{{ $username }}" disabled>
                    </div>
                    <div class="d-flex mb-4 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Email</h2>
                        <input type="email" class="fs-5 fw-medium my-auto text-end form-control" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" value="{{ $email }}" disabled>
                    </div>
                    <div class="d-flex mb-5 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Joined On</h2>
                        <h5 class="my-auto text-end">{{ $created_at }}</h5>
                    </div>
                    <div class="d-flex ms-4 bg-transparent justify-content-end">
                        <button type="button" class="btn mx-1" onclick="location.href='{{ route('edit-profile') }}'">Edit Profile
                        </button>
                        <button type="button" class="btn mx-1" onclick="location.href='{{ route('logout') }}'">Logout</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="statistics-section" class="mt-4 mx-4">
            <h1 class="ms-4 mt-4 fw-semibold">Statistics</h1>
            <div class="text-end me-5">
                <h5 class="fw-semibold">Total Animes</h5>
                <h1 class="fw-semibold">{{ $totalCount }}</h1>
            </div>
            <div id="statistics_chart" class="mx-auto" style="width: 1000px; height: 540px; margin-top: -100px;"></div>
            <button type="button" class="btn" onclick="location.href='{{ route('anime-list') }}'">View My Anime List
            </button>
        </div>
    </div>
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
                ["Liked", {{ $liked }}, "#2CCCFF"],
                ["Plan to Watch", {{ $plan_to_watch }}, "#57F000"],
                ["Currently Watching", {{ $currently_watching }}, "#FBE83A"],
                ["Disliked", {{ $disliked }}, "color: #FFB302"],
                ["Won't Watch", {{ $wont_watch }}, "color: #FE3839"],
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
                    minValue: 0,
                    format: "decimal",
                    textStyle: {
                        color: "#FFFFFF",
                        fontName: "Poppins",
                    }
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
</x-main-layout>
