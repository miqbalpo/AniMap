<x-account-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Sign Up to AniMap</h1>
    <form id="signup-form" action="{{ route('register.create-account') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="username-input" class="form-label">Name</label>
            <input type="text" name="username" class="form-control border-info" placeholder="AnonymousUser123" minlength="5" required>
        </div>
        <div class="mb-4">
            <label for="email-input" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control border-info" placeholder="name@example.com" required>
        </div>
        <div class="mb-4">
            <label for="password-input" class="form-label">Password</label>
            <input type="password" name="password" class="form-control border-info" minlength="8" required>
        </div>
        <div class="mb-4">
            <label for="password-input" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control border-info" minlength="8" required>
            <div id="password-warning" class="text-danger mb-1" style="display: none;">The passwords must match.</div>
        <div class="mb-4">
            <label for="image-input" class="form-label">Select a Profile Picture</label>
            <input type="file" name="profile_pic" accept="image/png, image/jpg, image/jpeg" class="form-control border-info">
        </div>
        <button type="submit" class="btn btn-primary d-block mx-auto" style="width: 50%; background-color: #1C8EDB; border: none;">Create Account</button>
    </form>
    <p class="mt-4 text-center">
        Already have an account? <a class="link-opacity-100 fw-bold" href="{{ route('login') }}" style="color: #BBE1FA;">Click here to login</a>
    </p>

    <script>
        const successMessage = "{{ session('success') }}";
        const errorMessage = "{{ $errors->first('email') }}";
        const profilePicErrorMessage = "{{ $errors->first('profile_pic') }}";

        window.onload = function() {
            if (successMessage) {
                console.log('Account creation successful:', successMessage);
                Swal.fire({
                    title: "Success",
                    text: "Account has been created!",
                    icon: "success",
                    iconColor: "#57F000",
                    confirmButtonColor: "#2CCCFF",
                    preConfirm: () => {
                        window.location.href = '/login';
                    }
                });
            }

            if (errorMessage) {
                console.log('Account creation failed:', errorMessage);
                event.preventDefault();
                Swal.fire({
                    title: "Error",
                    text: "The email has already been taken.",
                    icon: "warning",
                    iconColor: "#FE3839",
                    confirmButtonColor: "#2CCCFF"
                });
            }

            if (profilePicErrorMessage) {
                console.log('Account creation failed:', profilePicErrorMessage);
                event.preventDefault();
                Swal.fire({
                    title: "Error",
                    text: "The profile picture size must not be greater than 4MB.",
                    icon: "warning",
                    iconColor: "#FE3839",
                    confirmButtonColor: "#2CCCFF"
                });
            }
        };

        // Password confirmation check
        document.getElementById('signup-form').addEventListener('submit', function(event) {
            const password = this.password.value;
            const confirmPassword = this.confirm_password.value;
            const warningMessage = document.getElementById('password-warning');

            // Reset warning message
            warningMessage.style.display = 'none';

            if (password !== confirmPassword) {
                event.preventDefault();
                warningMessage.style.display = 'block';
            }
        });
    </script>

</x-account-layout>
