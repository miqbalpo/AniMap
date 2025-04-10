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
        width: 100px;
        background-color: #1B262C;
        color: white;
        font-weight: 500;
        border: none;
    }
    .navbar .btn{
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
    .username:first-child{
        width: max-content;
    }
    .username{
        max-width: 150px;
    }
    .btn-dropdown{
        color: white;
        font-size: 1rem;
        width: 120px;
        border: none;
        background: transparent;
    }
</style>

<nav class="navbar d-flex">
    <h3 class="app-name">AniMap</h3>
    <div class="justify-content-end">

    @guest
        <button type="button" class="btn" onclick="location.href='{{ route('register') }}'">Register
        </button>
        <button type="button" class="btn" onclick="location.href='{{ route('login') }}'">Login
        </button>
    @endguest

    @auth
         <button type="button" class="username btn-dropdown ms-auto fw-semibold" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth::user()->profile_pic == null)
                <img src="{{ asset('image/placeholder_pfp.png')}}" alt="">
            @else
                <img src="/{{Auth::user()->profile_pic}}" alt="">
            @endif
        </button>
        <button type="button" class="username btn-dropdown ms-auto fw-semibold text-truncate" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}
        </button>
        <ul class="account-menu dropdown-menu dropdown-menu-end justify-content-end">
            <li><a class="dropdown-item" href="{{ route('home') }}">Home</a></li>
            <li><a class="dropdown-item" href="{{ route('account-info') }}">Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('anime-list') }}">My Anime List</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
        </ul>
    @endauth
    </div>
</nav>

