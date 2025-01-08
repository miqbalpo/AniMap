<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Welcome to AniMap</h1>
    <div class="container-fluid mb-5">
        <form class="d-flex search-bar mx-auto" role="search">
            <input class="form-control me-2" type="search" placeholder="Type to Search" aria-label="Search">
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
    <h2 class="text-center fw-semibold">Recommended For You</h2>
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

        <div class="w-100 d-none d-md-block"></div>

        <div class="card bg-transparent text-white">
            <div class="card-body bg-transparent ">
                <a href="#" class="btn btn-primary bg-transparent">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" alt="...">
                    <h5 class="card-title mt-4 fs-5 text-center">Love Live! Nijigasaki</h5>
                </a>
            </div>
        </div>

    </div>
</x-main-layout>
