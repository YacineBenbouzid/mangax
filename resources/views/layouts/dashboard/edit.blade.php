@extends('dashboard')


@section('styles')
<style>
    /* General Container Styling */
    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #1a1c2c; /* Dark background */
        padding: 20px;
        border-radius: 8px;
        /*color: #e0e0e0; /* Light text color */
    }

    /* Section Titles */
    .container h2 {
        color: #EB1616; /* Blue color for section titles */
        font-size: 24px;
        margin-bottom: 20px;
    }

    /* Form Layout */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .form-group {
        flex: 1;
        min-width: 250px; /* Adjust as necessary to maintain layout on smaller screens */
    }

    /* Labels */
    .form-group label {
        color: #6C7293; /* Blue color for labels */
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    /* Input Fields */
    .form-control {
        width: 100%;
        padding: 10px;
        background-color: #000000; /* Darker background for input fields */
        border: 1px solid #eb161600; /* Blue border color */
        border-radius: 4px;
        color: #6C7293; /* White text color */
    }

    .form-control::placeholder {
        color: #000000; /* Light gray for placeholders */
    }

    /* Checkbox */
    input[type="checkbox"] {
        margin-right: 8px;
    }

    /* Button */
    .btn-primary {
        background-color: #EB1616 !important; /* Blue background */
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        /*color: #ffffff; /* White text */
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #357ab8; /* Darker blue on hover */
    }

    /* Alert */
    .alert-success {
        background-color: #4caf50; /* Success background */
        color: #ffffff; /* White text */
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    input:-webkit-autofill,
    textarea:-webkit-autofill,
    select:-webkit-autofill {
        background-color: black !important;
        color: #6C7293 !important;
        transition: background-color 5000s ease-in-out 0s, color 5000s ease-in-out 0s;
    }





</style>
@endsection
@section('content')

<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <div class="form-row">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $profile->username ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $profile->email ?? '') }}">
            </div>
        </div>

        <!-- Additional Fields -->
        <div class="form-row">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $profile->phone ?? '') }}">
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" name="birthday" value="{{ old('birthday', $profile->birthday ?? '') }}">
            </div>
        </div>

        <!-- Address Information -->
        <div class="form-row">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" value="{{ old('address', $profile->address ?? '') }}">
            </div>

            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $profile->job_title ?? '') }}">
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="form-row">
            <div class="form-group">
                <label for="linkedin">LinkedIn</label>
                <input type="url" class="form-control" name="linkedin" value="{{ old('linkedin', $profile->linkedin ?? '') }}">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control" name="profile_picture">
            </div>
        </div>

        <!-- Settings -->
        <div class="form-group">
            <label for="public_visibility">Public Visibility</label>
            <input type="checkbox" name="public_visibility" {{ old('public_visibility', $profile->public_visibility ?? false) ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Save Profile</button>
    </form>
</div>

@endsection

