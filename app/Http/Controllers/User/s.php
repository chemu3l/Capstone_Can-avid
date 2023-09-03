<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyCustomEmail;


class UserController extends Controller
{
    // Get Own Data
    public function GetOwnData()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profiles = Profile::where('id', $user->profile->id)->get();
            return view('settings', compact('profiles'));
        } else {
            return redirect()->route('login');
        }
    }
    //To EDIT User
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
            return redirect()->back()->with('error', 'Unable to Update User!');
        }
        $findUser = Profile::find(Auth::user()->id);
        if (!$findUser) {
            return redirect()->route('home')->with('error', 'User not found!');
        }
        $findUser->user()->update([
            'email' => $findUser->user->email,
            'role' => $findUser->user->role
        ]);
        $findUser->update([
            'age' => $validate['age'],
            'gender' => $validate['gender'],
            'position' => $validate['position'],
            'department' => $validate['department'],
            'phone_number' => $validate['phone_number'],
        ]);
        return redirect()->back()->with('success', 'User updated successfully.');
    }
    //To Delete User

    public function updateProfilePicture(Request $request)
    {
        $validate = $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        if (!$validate) {
            return redirect()->back()->with('fail', 'Unable to Update User!');
        }
        $findUser = Profile::find(Auth::user()->id);
        if (!$findUser) {
            return redirect()->back()->with('fail', 'User not found!');
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
}
