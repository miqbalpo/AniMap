<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card bg-transparent text-white">
        <div class="card-body bg-transparent">
            <div class="d-flex btn bg-transparent">
                <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" alt="...">
                <div id="overview-section">
                    <h1 class="ms-4 mb-4 fw-semibold">Love Live! Nijigasaki</h1>
                    <div class="d-flex ms-4 btn bg-transparent">
                        <div class="icon-info d-flex mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-star-fill my-auto text-warning" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                            <h5 class="ms-3 my-auto">10</h5>
                        </div>
                        <div class="icon-info d-flex mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-calendar3  my-auto" viewBox="0 0 16 16">
                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                            </svg>
                            <h5 class="ms-3 my-auto">Fall 2002</h5>
                        </div>
                        <div class="icon-info d-flex mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-broadcast  my-auto" viewBox="0 0 16 16">
                                <path d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707m2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708m5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708m2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                            </svg>
                            <h5 class="ms-3 my-auto">TV</h5>
                        </div>
                        <div class="icon-info d-flex mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-film  my-auto" viewBox="0 0 16 16">
                                <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                            </svg>
                            <h5 class="ms-3 my-auto">Sunrise</h5>
                        </div>
                    </div>
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
        <div id="info-section" class="d-flex ms-4">
            <div id="details-section" class="card text-center">
                <h4 class="my-3">Details</h4>
                <div class="d-flex ms-3">
                   <h6>Type: </h6>
                   <p>movie</p>
                </div>
                <div class="d-flex ms-3">
                    <h6>Episodes: </h6>
                    <p>movie</p>
                 </div>
                 <div class="d-flex ms-3">
                    <h6>Aired: </h6>
                    <p>movie</p>
                 </div>
                 <div class="d-flex ms-3">
                    <h6>Premiered: </h6>
                    <p>movie</p>
                 </div>
                 <div class="d-flex ms-3">
                    <h6>Broadcast: </h6>
                    <p>movie</p>
                 </div>
                 <div class="d-flex ms-3">
                     <h6>Producers: </h6>
                     <p>movie</p>
                  </div>
                  <div class="d-flex ms-3">
                     <h6>Licensors: </h6>
                     <p>movie</p>
                  </div>
                  <div class="d-flex ms-3">
                     <h6>Studios: </h6>
                     <p>movie</p>
                  </div>
                  <div class="d-flex ms-3">
                    <h6>Source: </h6>
                    <p>movie</p>
                 </div>
                 <div class="d-flex ms-3">
                     <h6>Genres: </h6>
                     <p>movie</p>
                  </div>
                  <div class="d-flex ms-3">
                     <h6>Theme: </h6>
                     <p>movie</p>
                  </div>
                  <div class="d-flex ms-3">
                     <h6>Demographic: </h6>
                     <p>movie</p>
                  </div>
                  <div class="d-flex ms-3">
                    <h6>Duration: </h6>
                    <p>movie</p>
                 </div>
                 <div class="d-flex ms-3">
                     <h6>Rating: </h6>
                     <p>movie</p>
                  </div>
            </div>
            <div id="synopsis-section" class="text-break text-justify mx-5">
                <h1 class="fw-semibold">Synopsis</h1>
                <p class="fs-5">
                    The Nijigasaki High School Idol Club continues to gain popularity as its reputation grows, even catching the attention of aspiring school idol Zhong Lanzhu. However, when Lanzhu visits the club and interacts with its members, she realizes that their ideals differ from her own. This sparks the beginning of a rivalry between Lanzhu and the club members, as she challenges them to see who can captivate a larger audience at the upcoming School Idol Festival.
                    <br>
                    Thus, the school idol club starts a new chapter in its quest to achieve idol stardom. Being more united than ever before, the girls continue to practice for the festival—wanting to show Lanzhu what it truly means to be a school idol.

[Written by MAL Rewrite]
                </p>
            </div>
        </div>
        <div id="characters-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Characters</h1>
            <div id="characters-list" class="row">
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="characters-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Staff</h1>
            <div id="characters-list" class="row">
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRsXfbkCBlF0Tb429WvkCbYLGx2cvlv89-Ljo4vkwfB4V31SHJ" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Lorem ipsum dolor sit amet.</p>
                        <p>Lorem ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="songs-section" class="mt-5 ms-4">

        </div>
        <div id="videos-section" class="mt-5 ms-4">

        </div>
    </div>
</x-main-layout>
