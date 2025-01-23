<style>
    .navbar{
        z-index: 1;
        width: 100%;
        position: fixed;
        top: 0;
        background-color: #1C8EDB;
        padding: 1rem;
    }
    .navbar .app-name{
        font-weight: 600;
    }
    .navbar .btn, .btn{
        /* position: fixed; */
        width: 100px;
        background-color: #1B262C;
        color: white;
        font-weight: 500;
        border: none;
    }
    a{
        text-decoration: none;
        color: white;
        font-weight: 600;
    }
    .navbar .btn:active{
        background-color: #2CCCFF;
    }
    .navbar img{
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
    }
    .btn-dropdown{
        color: white;
        font-size: 1rem;
        width: 120px;
        border: none;
        background: transparent;
    }
    .account-menu{
        position: absolute !important;
        top: 85% !important;
        left: 85% !important;
    }
</style>

<nav class="navbar d-flex">
    <h3 class="app-name">AniMap</h3>
    <div class="justify-content-end">
        {{-- <button type="button" class="btn">
            <a href="{{ route('register') }}">Register</a>
        </button>
        <button type="button" class="btn">
            <a href="{{ route('login') }}">Login</a>
        </button> --}}

        <img src="https://image.civitai.com/xG1nkqKTMzGDvpLrqFT7WA/5e7ef2ba-3c04-472a-adfa-b191c870b40e/anim=false,width=450/32455-29506324-(best%20quality,%20masterpiece_1.2),%201girl,%20solo,%20anime,%20anime%20screencap,%20%20ray%20tracing,%20global%20illumination,%20ultra%20resolution%20image,.jpeg" alt="">
        <button type="button" class="btn-dropdown dropdown-toggle ms-auto fw-semibold" data-bs-toggle="dropdown" aria-expanded="false">Yu Takasaki</button>
        <ul class="account-menu dropdown-menu justify-content-end position-absolute">
            <li><a class="dropdown-item" href="{{ route('welcome') }}">Home</a></li>
            <li><a class="dropdown-item" href="{{ route('account-info') }}">Profile</a></li>
            <li><a class="dropdown-item" href="anime-list">My Anime List</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
    </div>
</nav>

