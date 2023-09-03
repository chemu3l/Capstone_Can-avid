<?php

namespace App\Http\Controllers\User;

use App\Models\Profile;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function Check_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:30'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Incorrect Credentials');
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('Guest'); // Redirect to the login page after logout
    }

    // Show the password change form
    public function showChangePasswordForm(Profile $profile)
    {
        return view('User_Functional_Views.view_ChangePassword')->with('profile', $profile);
    }

    // Handle the password change form submission
    public function changePassword(Request $request, Profile $profile)
    {
        // Validate the form data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        if (Hash::check($request->current_password, $profile->user->password)) {
            // Update the user's password
            $findUser = User::find($profile->user_id);
            $findUser->update([
                'password' => Hash::make($request->new_password)
            ]);
            // Redirect to a success page or home
            return redirect()->route('home')->with('success', 'Password changed successfully.');
        } else {
            // If the current password doesn't match, return an error
            return redirect()->back()->with(['error' => 'The current password is incorrect.']);
        }
    }
}
