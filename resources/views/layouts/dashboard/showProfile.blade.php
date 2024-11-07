@extends('dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Profile Card -->
            <div class="card profile-card">
                <div class="card-header text-center">
                    <img src="{{ $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : 'https://via.placeholder.com/150' }}" 
                         class="rounded-circle profile-picture" alt="Profile Picture">
                    <h3 class="mt-3">{{ $profile->first_name }} {{ $profile->last_name }}</h3>
                    <p class="text-muted">{{ $profile->job_title ?? 'Job Title' }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Personal Info -->
                        <div class="col-md-6">
                            <h5>Contact Information</h5>
                            <p><strong>Email:</strong> {{ $profile->email ?? 'Not Provided' }}</p>
                            <p><strong>Phone:</strong> {{ $profile->phone ?? 'Not Provided' }}</p>
                            <p><strong>Address:</strong> {{ $profile->address ?? 'Not Provided' }}</p>
                            <p><strong>City:</strong> {{ $profile->city ?? 'Not Provided' }}</p>
                        </div>
                        <!-- Bio and Social Links -->
                        <div class="col-md-6">
                            <h5>Bio</h5>
                            <p>{{ $profile->bio ?? 'This user has not added a bio yet.' }}</p>
                            <h5>Social Links</h5>
                            <div class="social-links">
                                <a href="{{ $profile->linkedin }}" target="_blank" class="btn btn-link">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                                <a href="{{ $profile->github }}" target="_blank" class="btn btn-link">
                                    <i class="fab fa-github"></i> GitHub
                                </a>
                                <a href="{{ $profile->twitter }}" target="_blank" class="btn btn-link">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" onclick="window.location='{{ route('profile.edit') }}'">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    .profile-card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 15px;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 3px solid #007bff;
        margin-top: -60px;
    }

    .social-links a {
        margin: 0 5px;
        color: #007bff;
        transition: color 0.3s ease;
    }

    .social-links a:hover {
        color: #0056b3;
    }

    .profile-card .card-header {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        color: #fff;
        padding: 40px 20px 20px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .profile-card .card-footer {
        border-top: 0;
        background: #f8f9fa;
    }

    .btn-link i {
        font-size: 1.2rem;
    }

    </style>
    <!-- Add this to your main layout file (e.g., layouts/app.blade.php) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@endsection
