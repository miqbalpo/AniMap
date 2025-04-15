<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Anime Search</h1>
    <div class="container-fluid mb-5">
        <form action="{{ route('search-results') }}" method="GET" class="d-flex search-bar mx-auto" role="search">
            @csrf
            <input name="anime_title" class="form-control me-2" type="search" placeholder="Search by title..." aria-label="Search" value="{{ $oldTitle }}">
            <input type="hidden" name="genre" id="selected-genre" value="{{ old('genre', $oldGenre) }}">
            <input type="hidden" name="min_score" id="min-score" value="{{ old('min_score', $minScore) }}">
            <input type="hidden" name="max_score" id="max-score" value="{{ old('max_score', $maxScore) }}">
            <input type="hidden" name="type" id="selected-type" value="{{ old('type', $oldType) }}">
            <input type="hidden" name="rating" id="selected-rating" value="{{ old('rating', $oldRating) }}">
            <input type="hidden" name="year" id="selected-year" value="{{ old('year', $oldYear) }}">
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
    <div id="anime-filters" class="container-fluid d-sm-flex gap-0 column-gap-3 justify-content-center">
        <p class="fw-semibold my-auto">Search By:</p>
        <div id="genre-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldGenre ? $oldGenre : 'Genre' }}
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

        <div id="score-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldScore ? $oldScore : 'Score' }}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="setScore('', '')">Score</a></li> <!-- Default option to reset score -->
                <li><a class="dropdown-item" onclick="setScore('8.00', '10.00')">10.0 - 8.00</a></li>
                <li><a class="dropdown-item" onclick="setScore('6.00', '7.99')">7.99 - 6</a></li>
                <li><a class="dropdown-item" onclick="setScore('3.00', '5.99')">5.99 - 3.00</a></li>
                <li><a class="dropdown-item" onclick="setScore(null, '2.99')">&lt; 2.99</a></li>
            </ul>
        </div>

        <div id="type-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldType ? ucfirst($oldType) : 'Type' }}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" onclick="setType('')">Type</a></li>
                <li><a class="dropdown-item" onclick="setType('tv', 'TV Series')">TV Series</a></li>
                <li><a class="dropdown-item" onclick="setType('movie', 'Movie')">Movie</a></li>
                <li><a class="dropdown-item" onclick="setType('ova', 'OVA')">OVA</a></li>
                <li><a class="dropdown-item" onclick="setType('special', 'Special')">Special</a></li>
                <li><a class="dropdown-item" onclick="setType('ona', 'ONA')">ONA</a></li>
                <li><a class="dropdown-item" onclick="setType('music', 'Music')">Music</a></li>
                <li><a class="dropdown-item" onclick="setType('cm', 'Commercial')">Commercial</a></li>
                <li><a class="dropdown-item" onclick="setType('pv', 'Promotional Video')">Promotional Video</a></li>
                <li><a class="dropdown-item" onclick="setType('tv_special', 'TV Special')">TV Special</a></li>
            </ul>
        </div>

        <div id="rating-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldRating ? ucfirst($oldRating) : 'Rating' }}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" onclick="setRating('', 'Rating')">Rating</a></li>
                <li><a class="dropdown-item" onclick="setRating('g', 'All Ages')">All Ages</a></li>
                <li><a class="dropdown-item" onclick="setRating('pg', 'Children')">Children</a></li>
                <li><a class="dropdown-item" onclick="setRating('pg13', 'Teens (13 or older)')">Teens (13 or older)</a></li>
                <li><a class="dropdown-item" onclick="setRating('r17', 'Violence & Profanity')">Violence & Profanity</a></li>
                <li><a class="dropdown-item" onclick="setRating('r', 'Mild Nudity')">Mild Nudity</a></li>
                <li><a class="dropdown-item" onclick="setRating('rx', 'Hentai')">Hentai</a></li>
            </ul>
        </div>

        <div id="year-dropdown" class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                {{ $oldYear ? $oldYear : 'Year' }}
            </button>
            <ul class="dropdown-menu" id="year-dropdown-menu">
                <li>
                    <a class="dropdown-item" onclick="setYear('')">Year</a>
                </li>
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
                    <a class="page-link" href="{{ route('search-results', [
                        '_token' => csrf_token(),
                        'anime_title' => $oldTitle ?? '',
                        'genre' => $oldGenre ?? '',
                        'min_score' => $minScore ?? '',
                        'max_score' => $maxScore ?? '',
                        'type' => $oldType ?? '',
                        'rating' => $oldRating ?? '',
                        'year' => $oldYear ?? '',
                        'page' => $currentPage - 1
                    ]) }}"> &lt; </a>
                </li>
            @endif

            @if($lastPage > 1)
                <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('search-results', [
                        '_token' => csrf_token(),
                        'anime_title' => $oldTitle ?? '',
                        'genre' => $oldGenre ?? '',
                        'min_score' => $minScore ?? '',
                        'max_score' => $maxScore ?? '',
                        'type' => $oldType ?? '',
                        'rating' => $oldRating ?? '',
                        'year' => $oldYear ?? '',
                        'page' => 1
                    ]) }}">1</a>
                </li>
            @endif

            @if($lastPage > 2 && $currentPage > 3)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif

            @for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++)
                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('search-results', [
                        '_token' => csrf_token(),
                        'anime_title' => $oldTitle ?? '',
                        'genre' => $oldGenre ?? '',
                        'min_score' => $minScore ?? '',
                        'max_score' => $maxScore ?? '',
                        'type' => $oldType ?? '',
                        'rating' => $oldRating ?? '',
                        'year' => $oldYear ?? '',
                        'page' => $i
                    ]) }}">{{ $i }}</a>
                </li>
            @endfor

            @if($currentPage < $lastPage - 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif

            @if($lastPage > 1)
                <li class="page-item {{ $currentPage == $lastPage ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('search-results', [
                        '_token' => csrf_token(),
                        'anime_title' => $oldTitle ?? '',
                        'genre' => $oldGenre ?? '',
                        'min_score' => $minScore ?? '',
                        'max_score' => $maxScore ?? '',
                        'type' => $oldType ?? '',
                        'rating' => $oldRating ?? '',
                        'year' => $oldYear ?? '',
                        'page' => $lastPage
                    ]) }}">{{ $lastPage }}</a>
                </li>
            @endif

            @if($currentPage < $lastPage)
                <li class="page-item">
                    <a class="page-link" href="{{ route('search-results', [
                        '_token' => csrf_token(),
                        'anime_title' => $oldTitle ?? '',
                        'genre' => $oldGenre ?? '',
                        'min_score' => $minScore ?? '',
                        'max_score' => $maxScore ?? '',
                        'type' => $oldType ?? '',
                        'rating' => $oldRating ?? '',
                        'year' => $oldYear ?? '',
                        'page' => $currentPage + 1
                    ]) }}"> &gt; </a>
                </li>
            @endif
        </ul>
    </div>

    <script>
        const genreList = @json($genreList);

        function setGenre(genreName, genreId) {
            document.getElementById('selected-genre').value = genreId;

            if (genreId === '') {
                document.querySelector('#genre-dropdown button').innerText = 'Genre';
            } else {
                const selectedGenre = genreList.find(genre => genre.mal_id == genreId);
                if (selectedGenre) {
                    document.querySelector('#genre-dropdown button').innerText = selectedGenre.name;
                }
            }
        }

        function setScore(minScore, maxScore) {
            document.getElementById('min-score').value = minScore;
            document.getElementById('max-score').value = maxScore;

            if (minScore === '' && maxScore === '') {
                document.querySelector('#score-dropdown button').innerText = 'Score';
            } else {
                document.querySelector('#score-dropdown button').innerText = minScore !== null ? `${maxScore} - ${minScore}` : '< 2.99';
            }
        }

        function setType(type, displayText) {
            document.getElementById('selected-type').value = type;
            if (type === '') {
                document.querySelector('#type-dropdown button').innerText = 'Type';
            } else {
                document.querySelector('#type-dropdown button').innerText = displayText;
            }
        }

        function setRating(value, displayText) {
            document.getElementById('selected-rating').value = value;
            if (value === '') {
                document.querySelector('#rating-dropdown button').innerText = 'Rating';
            } else {
                document.querySelector('#rating-dropdown button').innerText = displayText;
            }
        }

        function setYear(year) {
            document.getElementById('selected-year').value = year;
            document.querySelector('#year-dropdown button').innerText = year ? year : 'Year';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectedGenreId = document.getElementById('selected-genre').value;
            if (selectedGenreId) {
                const selectedGenre = genreList.find(genre => genre.mal_id == selectedGenreId);
                if (selectedGenre) {
                    document.querySelector('#genre-dropdown button').innerText = selectedGenre.name;
                }
            } else {
                document.querySelector('#genre-dropdown button').innerText = 'Genre';
            }

            const minScore = document.getElementById('min-score').value;
            const maxScore = document.getElementById('max-score').value;
            if (minScore !== '' && maxScore !== '') {
                document.querySelector('#score-dropdown button').innerText = `${maxScore} - ${minScore}`;
            } else if (maxScore !== '') {
                document.querySelector('#score-dropdown button').innerText = '< 2.99';
            }

            const selectedType = document.getElementById('selected-type').value;
            if (selectedType) {
                const typeTextMap = {
                    'tv': 'TV Series',
                    'movie': 'Movie',
                    'ova': 'OVA',
                    'special': 'Special',
                    'ona': 'ONA',
                    'music': 'Music',
                    'cm': 'Commercial',
                    'pv': 'Promotional Video',
                    'tv_special': 'TV Special'
                };
                document.querySelector('#type-dropdown button').innerText = typeTextMap[selectedType] || 'Type';
            } else {
                document.querySelector('#type-dropdown button').innerText = 'Type';
            }

            const selectedRating = document.getElementById('selected-rating').value;
            if (selectedRating) {
                const ratingTextMap = {
                    'g': 'All Ages',
                    'pg': 'Children',
                    'pg13': 'Teens (13 or older)',
                    'r17': 'Violence & Profanity',
                    'r': 'Mild Nudity',
                    'rx': 'Hentai'
                };
                document.querySelector('#rating-dropdown button').innerText = ratingTextMap[selectedRating] || 'Rating';
            } else {
                document.querySelector('#rating-dropdown button').innerText = 'Rating';
            }

            const yearDropdownMenu = document.getElementById('year-dropdown-menu');
            const currentYear = new Date().getFullYear();
            const startYear = 1950;

            for (let year = currentYear; year >= startYear; year--) {
                const listItem = document.createElement ('li');
                const anchor = document.createElement('a');
                anchor.className = 'dropdown-item';
                anchor.innerText = year;
                anchor.onclick = function() {
                    setYear(year);
                };
                listItem.appendChild(anchor);
                yearDropdownMenu.appendChild(listItem);
            }
        });
    </script>
</x-main-layout>
