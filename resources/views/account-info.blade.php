<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-layout></x-search-layout>
    <div class="bg-transparent mx-auto text-white">
        <div id="account-info-section" class="mx-auto mb-5">
            <h1 class="mb-4 fw-semibold text-center">Account Information</h1>
            <div class="d-flex bg-transparent">
                <div id="profile-picture">
                    <img src="https://image.civitai.com/xG1nkqKTMzGDvpLrqFT7WA/5e7ef2ba-3c04-472a-adfa-b191c870b40e/anim=false,width=450/32455-29506324-(best%20quality,%20masterpiece_1.2),%201girl,%20solo,%20anime,%20anime%20screencap,%20%20ray%20tracing,%20global%20illumination,%20ultra%20resolution%20image,.jpeg" class="card-img-top" alt="...">
                    <button type="button" class="profile-pic-btn btn mt-3" disabled>
                        <a href="#">Change Profile Picture</a>
                    </button>
                </div>
                <div id="account-details" class="text-start">
                    <div class="d-flex mb-4 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Name</h2>
                        <input type="text" class="fs-5 fw-medium my-auto text-end form-control" placeholder="username" aria-label="Username" aria-describedby="basic-addon1" value="Yu Takasaki" disabled>
                    </div>
                    <div class="d-flex mb-4 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Email</h2>
                        <input type="email" class="fs-5 fw-medium my-auto text-end form-control" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" value="admin@gmail.com" disabled>
                    </div>
                    <div class="d-flex mb-5 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Joined On</h2>
                        <h5 class="my-auto text-end">7 September 2003</h5>
                    </div>
                    <div class="d-flex ms-4 bg-transparent justify-content-end">
                        {{-- <button type="button" class="btn mx-1">
                            <a href="#">Edit Profile</a>
                        </button>
                        <button type="button" class="btn mx-1">
                            <a href="#">Logout</a>
                        </button> --}}

                        <button type="button" class="btn mx-1">
                            <a href="#">Save Changes</a>
                        </button>
                        <button type="button" class="btn mx-1">
                            <a href="#">Cancel</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="statistics-section" class="mt-4 mx-4">
            <h1 class="ms-4 mt-4 fw-semibold">Statistics</h1>
            <div class="text-end me-5">
                <h5 class="fw-semibold">Total Animes</h5>
                <h1 class="fw-semibold">100</h1>
            </div>
            <div id="statistics_chart" class="mx-auto" style="width: 1000px; height: 540px; margin-top: -100px;"></div>
            <button type="button" class="btn" onclick="location.href='{{ route('anime-list') }}'">View My Anime List
            </button>
        </div>
    </div>
</x-main-layout>
