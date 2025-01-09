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
</style>

<nav class="navbar d-flex">
    <h3 class="app-name">AniMap</h3>
    <div class="justify-content-end">
        <button type="button" class="btn">
            <a href="{{ route('register') }}">Register</a>
        </button>
        <button type="button" class="btn">
            <a href="{{ route('login') }}">Login</a>
        </button>
    </div>
</nav>

