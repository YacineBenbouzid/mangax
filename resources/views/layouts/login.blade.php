@extends('app')

@section('title', 'Sign in')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/singin.css') }}">
<style>
    .span{
        color: var(--red);
        font-family: var(--fontNav); 
    }
</style>
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
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="input_item">
                    <input type="email" name="email" placeholder="Email address">
                    <span class="icon_mail"></span>
                </div>
                <div class="input_item">
                    <input type="Password" name="password" placeholder="Password">
                    <span class="icon_lock"></span>
                </div>
                @error('email')
                    <span class="span">{{  $message }}</span>
                @enderror
                <button type="submit" class="signuptbutton">Login Now</button>
            </form>
        </div>
        <div class="line"></div>
        <div class="ask">
            <h2>Dont’t Have An Account?</h2>
            <a href="{{route('signup')}}">Sign Up</a>
        </div>
    </div>
    <div class="signbuttom">
        <h2>OR</h2>
        <div><a href="">SIGN IN WITH GOOGLE</a></div>
    </div>
</div>
@endsection


