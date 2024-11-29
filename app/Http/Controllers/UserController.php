<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Redirect;
use Session;

class UserController extends Controller
{
    

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',  // You may want to specify accepted roles if necessary
            'email' => 'required|string|email|max:255|unique:users,email', // Email format and uniqueness
            'password' => [
                'required',
                'string',
                'min:8',             
                /*'regex:/[a-z]/',     
                'regex:/[A-Z]/',     
                'regex:/[0-9]/',     
                'regex:/[\W_]/', */    
            ],
        ]);
        
        // Create a new user
        $user =User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role'  => $validated['role'],
            'password' => Hash::make($validated['password']), // Hashing password before storing
        ]);
        
        Profile::create([
            'user_id' => $user->id,  // Foreign key to the user
            'first_name' => '', // Or set default values if necessary
            'last_name' => '',
            'username' => $user->name,
            'email' => $user->email,
            'phone' => '',
            'birthday' => null,
            'address' => '',
            'job_title' => '',
            'linkedin' => '',
            'profile_picture' => '',
            'public_visibility' => false,
        ]);
        $credentials= ['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
        }
        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');

    }

    public function login(Request $request)
    {
        $validated = $request->validate([


            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials= ['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('Dashboard');
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');         }
    }
    public function logout(){

        Session::flush();
        Auth::logout();
        return redirect('/');

    }
    public function lead(){
        if(Auth::check()){
            if(auth()->user()->role=='creator_user'){
                return Redirect('Dashboard/creatorUser');
            }
            if(auth()->user()->role=='company_user'){
                return Redirect('Dashboard/companyUser');
            }
            if(auth()->user()->role=='admin'){
                return Redirect('Dashboard/admin');
            }
        }
        return redirect('/');

    }
}
