<!-- resources/views/auth/verify-email.blade.php -->

@extends('app')
@section('title', 'verify')
@section('styles')
<style>
    .resend{
        display:flex;
        color:var(--white);
        font-family: var(--fontNav);
        flex-direction:column;
    }
    .vrow {
        display:flex;
        justify-content: center;

    }
    button{
        padding: 12px;
        font-size: large;
        color:var(--white);
        background-color: var(--red);
        border: none;
        margin-top: 7vh
    }
</style>
@endsection
@section('content')
    <div class="resend">
        <h1 class="vrow">Email Verification</h1>
        
        <p class="vrow">
            Before proceeding, please check your email for a verification link.
            If you did not receive the email, click below to resend the verification link.
        </p>
        
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
        @endif
        
        <form method="POST" class="vrow" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Resend Verification Email</button>
        </form>
    </div>
    <div class="vide"></div>
    <div class="vide"></div>
@endsection
