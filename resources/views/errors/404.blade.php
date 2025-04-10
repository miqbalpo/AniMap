<x-main-layout>
    <x-slot:title>Page Not Found</x-slot:title>
    <style>
        #not_found_section {
            margin-top: 30vh;
        }
        h1{
            font-size: 5rem;
        }
        .justify-content-center{
            width: 100%;
        }
        .btn{
            width: 200px;
        }
        .btn:hover, .btn:active{
            background-color: #2CCCFF;
        }
    </style>
    <div id="not_found_section" class="row justify-content-center d-block">
        <h1 class="text-center fw-semibold">404</h1>
        <h3 class="text-center fw-semibold">The page you are looking for is unavailable...</h3>
        <div class="d-flex justify-content-center mx-auto mt-5">
            <button type="button" class="btn" onclick="window.history.back();">Go back</button>
        </div>
    </div>
</x-main-layout>
