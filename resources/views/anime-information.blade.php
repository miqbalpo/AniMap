<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card bg-transparent text-white">
        <div class="card-body bg-transparent">
            <div class="d-flex btn bg-transparent">
                <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" alt="...">
                <h1 class="mb-4 text-center fw-semibold">Anime Search</h1>
                <div class="d-flex btn bg-transparent">
                    <p>1</p>
                    <p>2</p>
                    <p>3</p>
                </div>
            </div>
            <div class="d-flex btn bg-transparent">
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

        </div>
    </div>
</x-main-layout>
