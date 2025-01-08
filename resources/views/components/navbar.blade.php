<style>
    .navbar{
        width: 100%;
        position: fixed;
        top: 0;
        background-color: #1B262C;
        padding: 1rem;
    }
    .navbar .btn, .btn{
        /* position: fixed; */
        width: 100px;
        background-color: #1C8EDB;
        color: white;
        border: none;
    }
    a{
        text-decoration: none;
        color: white;
        font-weight: 400;
    }
    .btn:active{
        background-color: red;
    }
</style>

<nav class="navbar d-flex justify-content-end">
    <div>
        <button type="button" class="btn">
            <a href="{{ route('register') }}">Register</a>
        </button>
        <button type="button" class="btn">
            <a href="{{ route('login') }}">Login</a>
        </button>
    </div>
</nav>

