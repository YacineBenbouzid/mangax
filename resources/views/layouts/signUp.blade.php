@extends('app')

@section('title', 'Home')

@section('content')

<style>
    .button-container {
        display: flex;
        gap: 20px;
        justify-content: start;
        margin-top: 20px;
    }
    .radio-button {
        display: none;
    }
    .label-button {
        color: white;
        padding: 10px 20px;
        border: 1px solid #ffffff;
        border-radius: 10px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .radio-button:checked + .label-button {
        background-color: #d1e7ff;
        border-color: #007bff;
        color: #007bff;
    }
    .label-button:hover {
        background-color: #f0f0f0;
        border-color: #e83e8c;
        color: rgb(0, 0, 0);
    }
    .roletxt{
        font-weight: 600;
        font-size: smaller;
    }
</style>



<section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Sign Up</h2>
                    <p>Welcome to LinkPortalX—the first platform that legally connects all your favorite stories! Bookmark series, explore new titles, and support creators with every click that takes you to their original site. Dive into endless adventures and enjoy your haven for stories!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Sign Up</h3>
                    <form action="{{ route('signUp.store') }}" method="POST">
                        @csrf
                        <div class="input__item">
                            <input type="email" name="email" placeholder="Email address" required>
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="name" placeholder="Your Name" required>
                            <span class="icon_profile"></span>
                        </div>
                        <div class="input__item">
                            <input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                            title="Must contain at least 8 characters, including an uppercase letter, a lowercase letter, a number, and a special character" required>
                            <span class="icon_lock"></span>
                        </div>

                        <h5 class="roletxt" >Please select your role:</h5>
                        
                        <div class="button-container">
                            <input type="radio" id="readers" name="role" value="reader_user" class="radio-button" required>
                            <label for="readers" class="label-button"  >Readers</label>
                            
                            <input type="radio" id="company-user" name="role" value="company_user" class="radio-button" required>
                            <label for="company-user" class="label-button" >Company</label>
                            
                            <input type="radio" id="creators" name="role" value="creator_user" class="radio-button" required>
                            <label for="creators" class="label-button"  >Creators</label>
                        </div>
                        
                        <button type="submit" class="site-btn">Login Now</button>
                    </form>
                    <h5>Already have an account? <a href="login">Log In!</a></h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__social__links">
                    <h3>Login With:</h3>
                    <ul>
                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a>
                        </li>
                        <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


