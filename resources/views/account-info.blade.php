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
            {{-- <div id="statistics_chart" class="mx-auto" style="width: 1000px; height: 540px; margin-top: -100px;"></div> --}}
            <div style="width:95%;">
                <canvas id="statistics_chart" style="height: 360px;"></canvas>
            </div>
            <button type="button" class="btn" onclick="location.href='{{ route('anime-list') }}'">View My Anime List</button>
            <div class="spacer"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('statistics_chart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Liked", "Plan to Watch", "Currently Watching", "Disliked", "Won't Watch"],
                datasets: [{
                    label: 'Number of Animes',
                    data: [{{ $liked }}, {{ $plan_to_watch }}, {{ $currently_watching }}, {{ $disliked }}, {{ $wont_watch }}],
                    fill: true,
                    barThickness: 40,
                    backgroundColor: [
                        '#2CCCFF',
                        '#57F000',
                        '#FBE83A',
                        '#FFB302',
                        '#FE3839'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'transparent'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white',
                            font: {
                                size: 14,
                                //weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }
        });
    </script>
</x-main-layout>
