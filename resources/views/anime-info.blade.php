<x-main-layout>
    <x-slot:title>{{ $animeTitle }}</x-slot:title>
    <x-search-layout></x-search-layout>
    <div class="card bg-transparent text-white">
        <div class="card-body bg-transparent">
            <div class="d-flex bg-transparent">
                <img src="{{ $thumbnail }}" class="card-img-top" alt="...">
                <div id="overview-section">
                    <h1 class="ms-4 mb-4 fw-semibold text-start">{{ $animeTitle }}</h1>
                    <div class="d-flex ms-4 bg-transparent">
                        <div class="icon-info d-flex ms-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-star-fill my-auto text-warning" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                            <h5 class="ms-3 my-auto">{{ $score }}</h5>
                        </div>
                        <div class="icon-info d-flex ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-calendar3  my-auto" viewBox="0 0 16 16">
                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                            </svg>
                            <h5 class="ms-3 my-auto">{{ $premiered }}</h5>
                        </div>
                        <div class="icon-info d-flex ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-broadcast  my-auto" viewBox="0 0 16 16">
                                <path d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707m2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708m5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708m2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                            </svg>
                            <h5 class="ms-3 my-auto">{{ $type }}</h5>
                        </div>
                        <div class="icon-info d-flex ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-film  my-auto" viewBox="0 0 16 16">
                                <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                            </svg>
                            <h5 class="ms-3 my-auto">{{ $studios }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex btn bg-transparent">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle ms-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: max-content;">
                        Add to List
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="info-section" class="d-flex mt-4 ms-4">
            <div id="details-section" class="card text-center">
                <h4 class="my-3">Details</h4>
                <div class="text-start ms-3">
                   <h6>Type: </h6>
                   <p>{{ $type }}</p>
                </div>
                <div class="text-start ms-3">
                    <h6>Episodes: </h6>
                    <p>{{ $episodes }}</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Status: </h6>
                    <p>{{ $status }}</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Aired: </h6>
                    <p>{{ $aired }}</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Premiered: </h6>
                    <p>{{ $premiered }}</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Broadcast: </h6>
                    <p>{{ $broadcast }}</p>
                 </div>
                 <div class="text-start ms-3">
                     <h6>Producers: </h6>
                     <p>{{ $producers }}</p>
                  </div>
                  <div class="text-start ms-3">
                     <h6>Licensors: </h6>
                     <p>{{ $licensors }}</p>
                  </div>
                  <div class="text-start mx-3">
                     <h6>Studios: </h6>
                     <p>{{ $studios }}</p>
                  </div>
                  <div class="text-start ms-3">
                    <h6>Source: </h6>
                    <p>{{ $source }}</p>
                 </div>
                 <div class="text-start ms-3">
                     <h6>Genres: </h6>
                     <p>{{ $genres }}</p>
                  </div>
                  <div class="text-start ms-3">
                     <h6>Themes: </h6>
                     <p>{{ $themes }}</p>
                  </div>
                  <div class="text-start ms-3">
                     <h6>Demographic: </h6>
                     <p>{{ $demographics }}</p>
                  </div>
                  <div class="text-start ms-3">
                    <h6>Duration: </h6>
                    <p>{{ $duration }}</p>
                 </div>
                 <div class="text-start ms-3">
                     <h6>Rating: </h6>
                     <p>{{ $rating }}</p>
                  </div>
            </div>
            <div id="synopsis-section" class="text-break text-justify mx-5">
                <h1 class="fw-semibold">Synopsis</h1>
                <p class="fs-5">
                    {{ $synopsis }}
                </p>
            </div>
        </div>
        <div id="characters-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Characters</h1>
            <div id="characters-list" class="row">
                @foreach ( $charactersData as $char)
                    <div class="characters-info d-flex my-3 col">
                        <img src="{{ $char['character']['images']['jpg']['image_url'] ?? 'Unknown' }}" class="card-img-top" width="36" height="48" alt="...">
                        <div class="ms-5 align-center">
                            <p class="fw-semibold">{{ $char['character']['name'] ?? 'Unknown' }}</p>
                            <p>{{ $char['role'] ?? 'Unknown' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="staff-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Staff</h1>
            <div id="staff-list" class="row">
                @foreach ( $staffData as $staff)
                    <div class="staff-info d-flex my-3 col">
                        <img src="{{ $staff['person']['images']['jpg']['image_url'] ?? 'Unknown' }}" class="card-img-top" width="36" height="48" alt="...">
                        <div class="ms-5 align-center">
                            <p class="fw-semibold">{{ $staff['person']['name'] ?? 'Unknown' }}</p>
                            <p>{{ is_array($staff['positions']) ? implode(', ', $staff['positions']) : ($staff['positions'] ?? 'Unknown') }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div id="songs-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Songs</h1>
            <div class="d-flex">
                <div id="op-list" class="ms-1 me-5">
                    <h3 class="fw-semibold">Openings</h3>
                    @foreach ( $songs['openings'] as $op)
                        <p>{{ $op }}</p>
                    @endforeach
                </div>
                <div id="ed-list" class="ms-5">
                    <h3 class="fw-semibold">Endings</h3>
                    @foreach ( $songs['endings'] as $ed)
                        <p>{{ $ed }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="videos-section" class="my-5 ms-4">
            <h1 class="fw-semibold">Trailer</h1>
            <div>
                <iframe width="360" height="240" src="https://www.youtube.com/embed/{{ $trailer }}?enablejsapi=1&wmode=opaque&autoplay=0">
                </iframe>
            </div>
        </div>
    </div>
</x-main-layout>
