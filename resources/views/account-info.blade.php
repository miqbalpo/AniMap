<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-layout></x-search-layout>
    <div class="bg-transparent mx-auto text-white">
        <div id="account-info-section" class="mx-auto mb-5">
            <h1 class="mb-4 fw-semibold text-center">Account Information</h1>
            <div class="d-flex bg-transparent">
                <div id="profile-picture">
                    <img src="{{Auth::user()-> profile_pic}}" class="card-img-top" alt="...">
                    <button type="button" class="profile-pic-btn btn mt-3" disabled>
                        <a href="#">Change Profile Picture</a>
                    </button>
                </div>
                <div id="account-details" class="text-start">
                    <div class="d-flex mb-4 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Username</h2>
                        <input type="text" class="fs-5 fw-medium my-auto text-end form-control" placeholder="username" aria-label="Username" aria-describedby="basic-addon1" value="{{Auth::user()-> name}}" disabled>
                    </div>
                    <div class="d-flex mb-4 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Email</h2>
                        <input type="email" class="fs-5 fw-medium my-auto text-end form-control" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" value="{{Auth::user()-> email}}" disabled>
                    </div>
                    <div class="d-flex mb-5 ms-4 bg-transparent">
                        <h2 class="ms-4 fw-semibold">Joined On</h2>
                        <h5 class="my-auto text-end">{{Auth::user()-> created_at}}</h5>
                    </div>
                    <div class="d-flex ms-4 bg-transparent justify-content-end">
                        <button type="button" class="btn mx-1" onclick="">Edit Profile
                        </button>
                        <button type="button" class="btn mx-1" onclick="location.href='{{ route('logout') }}'">Logout</button>

                        {{-- <button type="button" class="btn mx-1">
                            <a href="#">Save Changes</a>
                        </button>
                        <button type="button" class="btn mx-1">
                            <a href="#">Cancel</a>
                        </button> --}}
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
