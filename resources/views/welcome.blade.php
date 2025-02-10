<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Welcome to AniMap</h1>
    <div class="container-fluid mb-5">
        <form action="{{ route('search-results') }}" method="GET" class="d-flex search-bar mx-auto" role="search">
            @csrf
            <input name="anime_title" class="form-control me-2" type="search" placeholder="Type to Search" aria-label="Search">
            <button class="btn" type="submit">Search</button>
        </form>
    </div>

    @guest
        <div class="row justify-content-center d-block mt-5">
            <h2 class="text-center fw-semibold" style="height: max-content;">Nothing to Show Here...</h2>
            <h4 class="text-center fw-semibold">Sign Up to Get Your Own Anime Recommendations</h4>
        </div>
    @endguest

    @auth
        <div id="recommendation-results" class="row justify-content-center">
            @if(isset($data['data']) && count($data['data']) > 0)
                <h2 class="text-center fw-semibold">Recommended For You</h2>

                @foreach ($data['data'] as $anime)
                    <div class="card bg-transparent text-white col-4">
                        <div class="card-body bg-transparent ">
                            <a href="{{ route('anime-info', ['id' => $anime['mal_id']]) }}" class="btn btn-primary bg-transparent">
                                <img src="{{ $anime['images']['jpg']['image_url'] }}" class="card-img-top" alt="{{ $anime['title'] }}">
                                <h5 class="card-title mt-4 fs-5 text-center">{{ $anime['title'] }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="pagination justify-content-center mt-4">
                    <ul class="pagination">
                        @if($currentPage > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('home', ['page' => $currentPage - 1]) }}"> &lt; </a>
                            </li>
                        @endif

                        @if($lastPage > 1)
                            <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('home', ['page' => 1]) }}">1</a>
                            </li>
                        @endif

                        @if($lastPage > 2 && $currentPage > 3)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        @for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++)
                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('home', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if($currentPage < $lastPage - 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        @if($lastPage > 1)
                            <li class="page-item {{ $currentPage == $lastPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('home', ['page' => $lastPage]) }}">{{ $lastPage }}</a>
                            </li>
                        @endif

                        @if($currentPage < $lastPage)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('home', ['page' => $currentPage + 1]) }}"> &gt; </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="bg-transparent text-white mt-5">
                    <div class="card-body bg-transparent">
                        <h2 class="text-center fw-semibold mb-5">Nothing to Show Here...</h2>
                        <h4 class="text-center fw-semibold">Start searching and adding animes to your list to get recommendations</h4>
                    </div>
                </div>
            @endif
        </div>
    @endauth
</x-main-layout>
