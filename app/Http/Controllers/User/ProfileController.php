<?php

namespace App\Http\Controllers\User;

use app\Models\profile;
use app\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgetPassword;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Auth\EmailVerificationNotification;

class ProfileController extends Controller
{
    public function GetOwnData()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profiles = User::where('id', $user->profile->user_id)->get();
            return view('settings', compact('profiles'));
        } else {
            return redirect()->route('login');
        }
    }
    public function Check_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:30'
        ]);
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            if (Auth::user()->role === "Admin") {
                return redirect()->route('home')->with(['Dashboard' => 'Admin Dashboard', 'status' => 'Admin Dashboard']);
            } elseif (Auth::user()->role === "Principal") {
                return redirect()->route('careers.index');
            } else {
                return redirect()->route('news.index');
            }
        } else {
            return redirect()->route('login')->with('error', 'Incorrect Credentials');
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('HomePage'); // Redirect to the login page after logout
    }
    // Show the password change form
    public function showChangePasswordForm(profile $profile)
    {
        return view('User_Functional_Views.view_ChangePassword')->with('profile', $profile);
    }

    // Handle the password change form submission
    public function changePassword(Request $request, profile $profile)
    {
        try {
            if (Auth::check()) {
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
                    return redirect()->back()->with('success', 'Password changed successfully.');
                } else {
                    // If the current password doesn't match, return an error
                    return redirect()->back()->with(['error' => 'The current password is incorrect.']);
                }
            } else {
                return redirect()->route('login')->with(['error' => 'Please login!.']);
            }
            # code...
        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => 'The current password is incorrect.']);
        }
    }
    public function SidenavShow()
    {
        if (Auth::check()) {
            return view('dashboard.sidebar');
        } else {
            return view('welcome');
        }
    }
    public function updateProfilePicture(Request $request)
    {
        $validate = $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        if (!$validate) {
            return redirect()->route('setting')->with('error', 'User not found!.');
        }
        $findUser = profile::find(Auth::user()->id);
        if (!$findUser) {
            return redirect()->route('setting')->with('error', 'User not found!.');
        }
        $newImages = null;
        if ($findUser->images) {
            Storage::delete('public/' . $findUser->images);
        }
        if ($request->hasFile('profile_picture')) {
            $picturePath = $request->file('profile_picture')->store('images/profile_pictures', 'public');
            $newImages = $picturePath;
        }

        $findUser->user()->update([
            'email' => $findUser->user->email,
            'role' => $findUser->user->role
        ]);
        $findUser->update([
            'age' => $findUser->age,
            'gender' => $findUser->gender,
            'position' => $findUser->position,
            'department' => $findUser->department,
            'phone_number' => $findUser->phone_number,
            'images' => $newImages
        ]);
        return redirect()->back()->with('success', 'Profile Picture Updated');
    }
    public function updateUser(Request $request)
    {
        $validate = $request->validate([
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:Male,Female',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'role' => 'string|max:255',
            'phone_number' => 'required|numeric',
        ]);
        if (!$validate) {
            return redirect()->route('setting')->with('error', 'User not found!.');
        }
        $findUser = User::find(Auth::user()->id);
        if (!$findUser) {
            return redirect()->route('setting')->with('error', 'User not found!.');
        }
        $findUser->update([
            'email' => $findUser->email,
            'role' => $findUser->role
        ]);
        $findUser->profile()->update([
            'age' => $validate['age'],
            'gender' => $validate['gender'],
            'position' => $validate['position'],
            'department' => $validate['department'],
            'phone_number' => $validate['phone_number'],
        ]);
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function getEmail()
    {
        return view('User_Functional_Views.forgetPassword');
    }
    public function forgetPassword(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        if (!$validate) {
            return redirect()->back();
        }
        Mail::to($request->email)->send(new forgetPassword($request->email));
        return redirect()->back();
    }
    public function showForgetPasswordForm($email)
    {
        return view('User_Functional_Views.view_forget_password')->with('email', $email);
    }
    public function changeForgetPassword(Request $request, $email)
    {
        $user = User::where('email', '=', $email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('login');
        }
        return redirect()->back()->with('error', 'User not found!.');
    }

    public function getVerify()
    {
        return view('auth.verify');
    }
    public function emailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/home');
    }
    public function postEmailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
