<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Anime Search</h1>
    <div class="container-fluid mb-5">
        <form class="d-flex search-bar mx-auto" role="search">
            <input class="form-control me-2" type="search" placeholder="Type to Search" aria-label="Search">
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
    <div class="container-fluid d-sm-flex gap-0 column-gap-3 justify-content-center">
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
    <div class="d-sm-flex row row-cols-1 row-cols-md-2 g-4 justify-content-center">
        <div class="card bg-transparent text-white">
            <div class="card-body bg-transparent ">
                <a href="#" class="btn btn-primary bg-transparent">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" alt="...">
                    <h5 class="card-title mt-4 fs-5 text-center">Love Live! Nijigasaki</h5>
                </a>
            </div>
        </div>
        <div class="card bg-transparent text-white">
            <div class="card-body bg-transparent ">
                <a href="#" class="btn btn-primary bg-transparent">
                    <img src="https://cdn.myanimelist.net/images/anime/1448/127956l.jpg" class="card-img-top" alt="...">
                    <h5 class="card-title mt-4 fs-5 text-center">Bocchi The Rock!</h5>
                </a>
            </div>
        </div>
        <div class="card bg-transparent text-white">
            <div class="card-body bg-transparent ">
                <a href="#" class="btn btn-primary bg-transparent">
                    <img src="https://cdn.myanimelist.net/images/anime/1332/143513l.jpg" class="card-img-top" alt="...">
                    <h5 class="card-title mt-4 fs-5 text-center">Makeine: Too Many Losing Heroines!</h5>
                </a>
            </div>
        </div>
        <div class="card bg-transparent text-white">
            <div class="card-body bg-transparent ">
                <a href="#" class="btn btn-primary bg-transparent">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" alt="...">
                    <h5 class="card-title mt-4 fs-5 text-center">Love Live! Nijigasaki</h5>
                </a>
            </div>
        </div>
        <div class="w-100 d-none d-md-block my-0"></div>
    </div>
</x-main-layout>
