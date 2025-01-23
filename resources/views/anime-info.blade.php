<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-layout></x-search-layout>
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
                            <h5 class="ms-3 my-auto">8.25</h5>
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
        <div id="info-section" class="d-flex mt-4 ms-4">
            <div id="details-section" class="card text-center">
                <h4 class="my-3">Details</h4>
                <div class="text-start ms-3">
                   <h6>Type: </h6>
                   <p>TV</p>
                </div>
                <div class="text-start ms-3">
                    <h6>Episodes: </h6>
                    <p>13</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Status: </h6>
                    <p>Finished Airing</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Aired: </h6>
                    <p>Oct 3, 2020 to Dec 26, 2020</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Premiered: </h6>
                    <p>Fall 2020</p>
                 </div>
                 <div class="text-start ms-3">
                    <h6>Broadcast: </h6>
                    <p>Saturdays at 22:30 (JST)</p>
                 </div>
                 <div class="text-start ms-3">
                     <h6>Producers: </h6>
                     <p>Bushiroad, Sunrise Music, Kadokawa, Bandai Namco Arts</p>
                  </div>
                  <div class="text-start ms-3">
                     <h6>Licensors: </h6>
                     <p>Funimation</p>
                  </div>
                  <div class="text-start mx-3">
                     <h6>Studios: </h6>
                     <p>Sunrise</p>
                  </div>
                  <div class="text-start ms-3">
                    <h6>Source: </h6>
                    <p>Other</p>
                 </div>
                 <div class="text-start ms-3">
                     <h6>Genres: </h6>
                     <p>Slice of Life</p>
                  </div>
                  <div class="text-start ms-3">
                     <h6>Theme: </h6>
                     <p>movie</p>
                  </div>
                  <div class="text-start ms-3">
                     <h6>Demographic: </h6>
                     <p>Idols (Female), Music, School</p>
                  </div>
                  <div class="text-start ms-3">
                    <h6>Duration: </h6>
                    <p>24 min. per ep.</p>
                 </div>
                 <div class="text-start ms-3">
                     <h6>Rating: </h6>
                     <p>PG-13 - Teens 13 or older</p>
                  </div>
            </div>
            <div id="synopsis-section" class="text-break text-justify mx-5">
                <h1 class="fw-semibold">Synopsis</h1>
                <p class="fs-5">
                    Buried within the numerous clubs at Nijigasaki High School lies the school idol club. The club, while lacking popularity, definitely does not lack potential. During their debut performance, they were able to seize a sizable audience, along with the attention of their schoolmates Ayumu Uehara and Yuu Takasaki.

                    Enamored, the duo makes their way to join the club; however, they are disappointed to find out that the club had just been disbanded. Nevertheless, Ayumu does not believe that it should have ended there. Together with Yuu, they begin restoring the school idol club, hoping to recreate the idol performances that dazzled them before.

                    Love Live! Nijigasaki Gakuen School Idol Doukoukai shines its spotlight over the reformed school idol club as they recruit both former members of the club alongside newcomers. Taking the first step towards their dreams, how will these girls achieve idol stardom?

                    [Written by MAL Rewrite]
                </p>
            </div>
        </div>
        <div id="characters-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Characters</h1>
            <div id="characters-list" class="row">
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/characters/2/421049.jpg?s=02e4f0ad6db780090bf8367ecc255544" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Takasaki, Yuu</p>
                        <p>Main</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/characters/9/421041.jpg?s=3b89889b504bc908fde7a9c8c8fd8a10" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Yuki, Setsuna</p>
                        <p>Main</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/characters/6/396294.jpg?s=77ea0a5e098eb7bf465cb1413f14d6a3" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Uehara, Ayumu</p>
                        <p>Main</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/characters/8/488261.jpg?s=eb0ebc6e3dacf1157f4b1d8b2d0417fc" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Nakasu, Kasumi</p>
                        <p>Main</p>
                    </div>
                </div>
                <div class="characters-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/characters/7/421048.jpg?s=9f3e56507b5575dc467b1c2280950c6b" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Ousaka, Shizuku</p>
                        <p>Main</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="staff-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Staff</h1>
            <div id="staff-list" class="row">
                <div class="staff-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/voiceactors/1/80501.jpg?s=ee808f428c434aee43fe003623f6bf0b" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Cook, Justin</p>
                        <p>Producer</p>
                    </div>
                </div>
                <div class="staff-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/questionmark_23.gif?s=f7dcbc4a4603d18356d3dfef8abd655c" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Oda, Makotor</p>
                        <p>Producer</p>
                    </div>
                </div>
                <div class="staff-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/questionmark_23.gif?s=f7dcbc4a4603d18356d3dfef8abd655c" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Ootsuka, Hiroshi</p>
                        <p>Producer</p>
                    </div>
                </div>
                <div class="staff-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/voiceactors/3/42874.jpg?s=aef91fd9132c86444be351f412b0cfeb" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Sabat, Christopher</p>
                        <p>Producer</p>
                    </div>
                </div>
                <div class="staff-info d-flex my-3 col-6">
                    <img src="https://cdn.myanimelist.net/images/voiceactors/3/74638.jpg?s=7f5fd56efee675d65b56bf1c154a10f6" class="card-img-top" width="36" height="48" alt="...">
                    <div class="ms-5 align-center">
                        <p class="fw-semibold">Herek, Samantha</p>
                        <p>Assistant Producer</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="songs-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Songs</h1>
            <div class="d-flex">
                <div id="op-list" class="ms-1 me-5">
                    <h3 class="fw-semibold">Openings</h3>
                    <p>1. "Nijiiro Passions! (虹色Passions!)" by Nijigasaki School Idol Club (虹ヶ咲学園スクールアイドル同好会)</p>
                </div>
                <div id="ed-list" class="ms-5">
                    <h3 class="fw-semibold">Endings</h3>
                    <p>1. "NEO SKY, NEO MAP!" by Nijigasaki School Idol Club (虹ヶ咲学園スクールアイドル同好会)</p>
                </div>
            </div>
        </div>
        <div id="videos-section" class="mt-5 ms-4">
            <h1 class="fw-semibold">Promotional Videos</h1>
            <div>
                <iframe width="360" height="240" src="https://www.youtube.com/embed/6rYT31OEFvk">
                </iframe>
            </div>
        </div>
    </div>
</x-main-layout>
