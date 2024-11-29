@extends('app')

@section('title', 'Sign in')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/singin.css') }}">

@endsection
@section('content') 
<div class="logcontent">
    <h1>Sign Up</h1>
    <h3>Welcome to LinkPortalX the first platform that legally connects all your favorite stories! Bookmark series, explore new titles, and support creators with every click that takes you to their original site. Dive into endless adventures and enjoy your haven for stories!</h3>
</div>
<div class="vide"></div>
<div class="singin">
    <div class="signtop">
        <div class="form">
            <form action="{{ route('signUp.store') }}" method="POST">
                @csrf
                <div class="input_item">
                    <input type="email" name="email" placeholder="Email address" required>
                    <span class="icon_mail"></span>
                </div>
                <div class="input_item">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <span class="icon_profile"></span>
                </div>
                <div class="input_item">
                    <input type="password" name="password" placeholder="Password" pattern=".{8,}"
                    title="Must contain at least 8 characters" required>
                    <span class="icon_lock"></span>
                </div>

                <h5 class="roletxt" >Please select your role:</h5>
                
                <div class="button-container">
                    <input type="radio" id="readers" name="role" value="reader_user" class="radio-button" required>
                    <label for="readers" class="label-button"  >Reader</label>
                    
                    <input type="radio" id="company-user" name="role" value="company_user" class="radio-button" required>
                    <label for="company-user" class="label-button" >Company</label>
                    
                    <input type="radio" id="creators" name="role" value="creator_user" class="radio-button" required>
                    <label for="creators" class="label-button"  >Creator</label>
                </div>
                
                <button type="submit" class="signuptbutton">Sign Up Now</button>
            </form>
        </div>
        <div class="line"></div>
        <div class="ask">
            <h2>Do You Have An Account?</h2>
            <a href="{{route('login')}}">Sign In</a>
        </div>
    </div>
    <div class="signbuttom">
        <h2>OR</h2>
        <div><a href="">SIGN UP WITH GOOGLE</a></div>
    </div>
</div>
@endsection


