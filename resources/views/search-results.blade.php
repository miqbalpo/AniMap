<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Anime Search</h1>
    <div class="container-fluid mb-5">
        <form action="{{ route('search-results') }}" method="GET" class="d-flex search-bar mx-auto" role="search">
            @csrf
            <input name="anime_title" class="form-control me-2" type="search" placeholder="Type to Search" aria-label="Search" value="{{ $oldTitle }}">
            <input type="hidden" name="genre" id="selected-genre" value="{{ old('genre', $oldGenre) }}">
            <input type="hidden" name="min_score" id="min-score" value="{{ old('min_score', $minScore) }}">
            <input type="hidden" name="max_score" id="max-score" value="{{ old('max_score', $maxScore) }}">
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
    <div id="anime-filters" class="container-fluid d-sm-flex gap-0 column-gap-3 justify-content-center">
        <p class="fw-semibold my-auto">Search By:</p>
        <div id="genre-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldGenre ? $oldGenre : 'Genre' }} <!-- Use oldGenre directly -->
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" onclick="setGenre('', '')">Select Genre</a>
                </li>
                @foreach ($genreList as $genre)
                    <li>
                        <a class="dropdown-item" onclick="setGenre('{{ $genre['name'] }}', '{{ $genre['mal_id'] }}')">
                            {{ $genre['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div id="rating-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldRating ? $oldRating : 'Rating' }} <!-- Use oldRating directly -->
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="setRating('', '')">Rating</a></li> <!-- Default option to reset rating -->
                <li><a class="dropdown-item" onclick="setRating('8.00', '10.00')">10.0 - 8.00</a></li>
                <li><a class="dropdown-item" onclick="setRating('6.00', '7.99')">7.99 - 6</a></li>
                <li><a class="dropdown-item" onclick="setRating('3.00', '5.99')">5.99 - 3.00</a></li>
                <li><a class="dropdown-item" onclick="setRating(null, '2.99')">&lt; 2.99</a></li>
            </ul>
        </div>

        <div id="theme-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Theme
            </button>
            <ul class="dropdown-menu">
                <!-- Theme options go here -->
            </ul>
        </div>

        <div id="demography-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                Demography
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" demography="">Josei</a></li>
                <li><a class="dropdown-item" href="#" demography="">Kids</a></li>
                <li><a class="dropdown-item" href="#" demography="">Seinen</a></li>
                <li><a class="dropdown-item" href="#" demography="">Shoujo</a></li>
                <li><a class="dropdown-item" href="#" demography="">Shounen</a></li>
            </ul>
        </div>

        <div id="year-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
               Year
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" year="">2025</a></li>
                <li><a class="dropdown-item" href="#" year="">2024</a></li>
                <li><a class="dropdown-item" href="#" year="">2023</a></li>
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

    <div class="pagination justify-content-center mt-4">
        <ul class="pagination">
            @if($currentPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ route('search-results', ['_token' => csrf_token(), 'anime_title' => $oldTitle, 'genre' => $oldGenre, 'min_score' => $minScore, 'max_score' => $maxScore, 'page' => $currentPage - 1]) }}"> &lt; </a>
                </li>
            @endif

            @if($lastPage > 1)
                <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('search-results', ['_token' => csrf_token(), 'anime_title' => $oldTitle, 'genre' => $oldGenre, 'min_score' => $minScore, 'max_score' => $maxScore, 'page' => 1]) }}">1</a>
                </li>
            @endif

            @if($lastPage > 2 && $currentPage > 3)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif

            @for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('search-results', ['_token' => csrf_token(), 'anime_title' => $oldTitle, 'genre' => $oldGenre, 'min_score' => $minScore, 'max_score' => $maxScore, 'page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor

            @if($currentPage < $lastPage - 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif

            @if($lastPage > 1)
            <li class="page-item {{ $currentPage == $lastPage ? 'active' : '' }}">
                <a class="page-link" href="{{ route('search-results', ['_token' => csrf_token(), 'anime_title' => $oldTitle, 'genre' => $oldGenre, 'min_score' => $minScore, 'max_score' => $maxScore, 'page' => $lastPage]) }}">{{ $lastPage }}</a>
            </li>
            @endif

            @if($currentPage < $lastPage)
                <li class="page-item">
                    <a class="page-link" href="{{ route('search-results', ['_token' => csrf_token(), 'anime_title' => $oldTitle, 'genre' => $oldGenre, 'min_score' => $minScore, 'max_score' => $maxScore, 'page' => $currentPage + 1]) }}"> &gt; </a>
                </li>
            @endif
        </ul>
    </div>

    <script>
        const genreList = @json($genreList); // Make sure genreList is available in JS

        function setGenre(genreName, genreId) {
            document.getElementById('selected-genre').value = genreId; // Set the selected genre ID

            // Update button text based on the selected genre
            if (genreId === '') {
                document.querySelector('#genre-dropdown button').innerText = 'Genre'; // Reset button text to 'Genre'
            } else {
                // Find the genre name from the genreList using the genreId
                const selectedGenre = genreList.find(genre => genre.mal_id == genreId);
                if (selectedGenre) {
                    document.querySelector('#genre-dropdown button').innerText = selectedGenre.name; // Update button text to the selected genre name
                }
            }
        }

        function setRating(minScore, maxScore) {
            document.getElementById('min-score').value = minScore; // Set the minimum score
            document.getElementById('max-score').value = maxScore; // Set the maximum score

            // Update button text based on the selected rating
            if (minScore === '' && maxScore === '') {
                document.querySelector('#rating-dropdown button').innerText = 'Rating'; // Reset to default text
            } else {
                document.querySelector('#rating-dropdown button').innerText = minScore !== null ? `${maxScore} - ${minScore}` : '< 2.99'; // Update button text
            }
        }

        // Update rating dropdown button text on page load
        document.addEventListener('DOMContentLoaded', function() {
                const selectedGenreId = document.getElementById('selected-genre').value;
            if (selectedGenreId) {
                const selectedGenre = genreList.find(genre => genre.mal_id == selectedGenreId);
                if (selectedGenre) {
                    document.querySelector('#genre-dropdown button').innerText = selectedGenre.name; // Set button text to the genre name
                }
            } else {
                document.querySelector('#genre-dropdown button').innerText = 'Genre'; // Reset to default text
            }

            const minScore = document.getElementById('min-score').value;
            const maxScore = document.getElementById('max-score').value;
            if (minScore !== '' && maxScore !== '') {
                document.querySelector('#rating-dropdown button').innerText = `${maxScore} - ${minScore}`;
            } else if (maxScore !== '') {
                document.querySelector('#rating-dropdown button').innerText = '< 2.99';
            }
        });
    </script>
</x-main-layout>
