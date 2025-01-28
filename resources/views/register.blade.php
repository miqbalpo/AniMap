<x-account-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center fw-semibold">Sign Up to AniMap</h1>
    <form action="{{ route('register.create-account') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="username-input" class="form-label">Username</label>
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
        {{-- <div class="mb-4">
            <label for="confirm-password-input" class="form-label">Confirm Password</label>
            <input type="password" name="confirm-password" class="form-control border-info">
        </div> --}}
            <div class="mb-4">
            <label for="image-input" class="form-label">Select a Profile Picture</label>
            <input type="file" name="profile_pic" accept="image/png, image/jpg, image/jpeg" class="form-control border-info">
        </div>
        <button type="submit" class="btn btn-primary d-block mx-auto" style="width: 50%; background-color: #1C8EDB; border: none;">Create Account</button>
    </form>
    <p class="mt-4 text-center">
        Already have an account? <a class="link-opacity-100 fw-bold" href="#" style="color: #BBE1FA;">Click here to login</a>
    </p>
</x-account-layout>
