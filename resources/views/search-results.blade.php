<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Anime Search</h1>
    <div class="container-fluid mb-5">
        <form action="{{ route('search-results') }}" method="GET" class="d-flex search-bar mx-auto" role="search">
            @csrf
            <input name="anime_title" class="form-control me-2" type="search" placeholder="Type to Search" aria-label="Search">
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
    <div id="anime-filters" class="container-fluid d-sm-flex gap-0 column-gap-3 justify-content-center" style="">
        <p class="fw-semibold my-auto">Search By:</p>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Genre
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Rating
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Theme
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Demography
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
               Year
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Episodes
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
    <div id="search-results" class="row justify-content-center">
        @if(isset($data['data']) && count($data['data']) > 0)
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
        @else
            <div class="bg-transparent text-white mt-5">
                <div class="card-body bg-transparent">
                    <h2 class="text-center fw-semibold">No Results Found</h2>
                </div>
            </div>
        @endif
    </div>
</x-main-layout>
