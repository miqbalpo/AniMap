<?php
    $profile_pic = Auth::user()-> profile_pic;
    $username = Auth::user()-> name;
    $email = Auth::user()-> email;
    $created_at = Auth::user()->created_at->format('d F Y');
?>

<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-layout></x-search-layout>
    <div class="bg-transparent mx-auto text-white">
        <div id="account-edit-section" class="mx-auto mb-5">
            <h1 class="mb-4 fw-semibold text-center">Edit Profile</h1>
            <form action="{{ route('account.save-info') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex bg-transparent">
                    <div id="profile-picture">
                        @if (Auth::user()->profile_pic == null)
                            <img id="profile-pic" src="{{ asset('image/placeholder_pfp.png')}}" class="card-img-top" alt="Profile Picture">
                        @else
                            <img id="profile-pic" src="/{{ $profile_pic }}" class="card-img-top" alt="Profile Picture">
                        @endif
                        <input type="file" name="profile_pic" accept="image/png, image/jpg, image/jpeg" class="d-none" id="file-input" onchange="previewImage(event)">
                        <button type="button" class="profile-pic-btn btn mt-3" onclick="document.getElementById('file-input').click();">
                            Change Profile Picture
                        </button>
                    </div>
                    <div id="account-details" class="text-start">
                        <div class="d-flex mb-4 ms-4 bg-transparent">
                            <h2 class="ms-4 fw-semibold">Username</h2>
                            <input type="text" name="username" class="fs-5 fw-medium my-auto text-end form-control" placeholder="{{ $username }}" aria-label="Username" aria-describedby="basic-addon1" minlength="5" value="{{ $username }}" required>
                        </div>
                        <div class="d-flex mb-4 ms-4 bg-transparent">
                            <h2 class="ms-4 fw-semibold">Email</h2>
                            <input type="email" name="email"  class="fs-5 fw-medium my-auto text-end form-control" placeholder="{{ $email }}" aria-label="Email" aria-describedby="basic-addon1" value="{{ $email }}" required>
                        </div>
                        <div class="d-flex mb-5 ms-4 bg-transparent">
                            <h2 class="ms-4 fw-semibold">Joined On</h2>
                            <h5 class="my-auto text-end">{{ $created_at }}</h5>
                        </div>
                        <div class="d-flex ms-4 bg-transparent justify-content-end">
                            <button type="submit" class="btn mx-1">Save Changes
                            </button>
                            <button type="button" class="btn mx-1" onclick="location.href='{{ route('account-info') }}'">Back
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const imgElement = document.getElementById('profile-pic');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imgElement.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        const successMessage = "{{ session('success') }}";
        const errorMessage = "{{ session('error') }}";

        window.onload = function() {
            if (successMessage) {
                Swal.fire({
                    title: "Success",
                    text: "Account has been updated!",
                    icon: "success",
                    iconColor: "#57F000",
                    confirmButtonColor: "#2CCCFF",
                    preConfirm: () => {
                        window.location.href = '/account-info';
                    }
                });
            }
            if (errorMessage) {
                Swal.fire({
                    title: "Error",
                    text: "Account failed to be updated.",
                    icon: "warning",
                    iconColor: "#FE3839",
                    confirmButtonColor: "#2CCCFF",
                    confirmButtonText: "Ok"
                });
            }
        };
    </script>
</x-main-layout>
