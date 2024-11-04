<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Redirect;
use Session;

class UserController extends Controller
{
    

    public function store(Request $request)
    {
        dd($request);
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',  // You may want to specify accepted roles if necessary
            'email' => 'required|string|email|max:255|unique:users,email', // Email format and uniqueness
            'password' => [
                'required',
                'string',
                'min:8',             // Minimum 8 characters
                'regex:/[a-z]/',      // At least one lowercase letter
                'regex:/[A-Z]/',      // At least one uppercase letter
                'regex:/[0-9]/',      // At least one digit
                'regex:/[\W_]/',      // At least one special character
            ],
        ]);
    
        // Create a new user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role'  => $validated['role'],
            'password' => Hash::make($validated['password']), // Hashing password before storing
        ]);
    
        // Regenerate session ID to avoid session fixation attacks
        $credentials= ['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('Dashboard')->with('success', 'User created successfully!');
        }
    
        // Redirect to the dashboard with a success message
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
