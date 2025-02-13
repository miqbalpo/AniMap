<x-account-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Login to AniMap</h1>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email-input" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control border-info" placeholder="name@example.com" required>
        </div>
        <div class="mb-4">
            <label for="password-input" class="form-label">Password</label>
            <input type="password" name="password" class="form-control border-info" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary d-block mx-auto" style="width: 50%; background-color: #1C8EDB; border: none;">Login</button>
    </form>
    <p class="mt-4 text-center">
        Don't have an account yet? <a class="link-opacity-100 fw-bold" href="{{ route('register') }}" style="color: #BBE1FA;">Click here to sign up</a>
    </p>

    <script>
        const errorMessage = "{{ session('errors') }}";

        window.onload = function() {
            if (errorMessage) {
                console.log('Login failed:', errorMessage);
                event.preventDefault();
                Swal.fire({
                    title: "Error",
                    text: "Invalid email or password.",
                    icon: "warning",
                    iconColor: "#FE3839",
                    confirmButtonColor: "#2CCCFF"
                });
            }
        };
    </script>
</x-account-layout>
