<x-account-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="mb-4 text-center">Sign Up to AniMap</h1>
    <form action="">
    <div class="mb-4">
        <label for="exampleFormControlInput1" class="form-label">Username</label>
        <input type="email" class="form-control border-info" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-4">
        <label for="exampleFormControlInput2" class="form-label">Email Address</label>
        <input type="email" class="form-control border-info" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-4">
        <label for="exampleFormControlInput3" class="form-label">Password</label>
        <input type="password" class="form-control border-info" id="exampleFormControlInput1">
    </div>
    <div class="mb-4">
        <label for="exampleFormControlInput4" class="form-label">Confirm Password</label>
        <input type="password" class="form-control border-info" id="exampleFormControlInput1">
    </div>
    <button type="submit" class="btn btn-primary d-block mx-auto" style="width: 50%; background-color: #1C8EDB; border: none;">Create Account</button>
    </form>
    <p class="mt-4 text-center">
        Already have an account? <a class="link-opacity-100 fw-bold" href="#" style="color: #BBE1FA;">Click here to login</a>
    </p>
</x-account-layout>
