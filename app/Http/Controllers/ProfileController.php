<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use Storage;

class ProfileController extends Controller
{
    // Show the profile form
    public function edit()
    {
        $user = auth()->user();
    
        // Check if the user has a profile, if not, create an empty one
        if (!$user->profile) {
            $user->profile()->create();
        }
    
        $profile = $user->profile;
        return view('layouts.dashboard.edit', compact('profile'));
    }
    

    // Save the profile data
    public function update(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'profile_picture' => 'nullable|image',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'public_visibility' => 'nullable',
            'receive_newsletter' => 'nullable|boolean',
        ]);
    
        // Handle the checkbox field for public visibility
        if ($request->has('public_visibility')) {
            $validatedData['public_visibility'] = $request->has('public_visibility') ? true : false;
        }
        
        // Retrieve the authenticated user's profile
        $profile = auth()->user()->profile;
        // Handling profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            
    
            // Store the new image
            $imagePath = $request->file('profile_picture')->store('images', 'public');
            $validatedData['profile_picture'] = $imagePath; // Set the new image path
        }
    
        // Update the profile with validated data
        $profile->update($validatedData);
    
        // Optionally, redirect or return a response
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
    
    
    public function show($id)
    {
        $profile = Profile::findOrFail($id); // Get the authenticated user's profile
        return view('layouts.dashboard.showProfile', compact('profile'));
    }
    public function myprofile()
    {
        $user = auth()->user();
    
        return [
            'name' => $user->name,
            'profile_picture' => $user->profile->image ?? null
        ];
    }
    
    
}
