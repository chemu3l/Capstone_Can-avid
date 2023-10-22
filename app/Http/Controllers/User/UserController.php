<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\profile;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangePassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profiles = profile::where('id', '<>', $user->profile->user_id)->get();
            return view('User.index_user', compact('profiles'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:Male,Female',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'picture' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if (!$validate) {
            return redirect()->back()->with('fail', 'Unable to Create User!');
        }
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make('12345678');
        $user->role = $request->input('role');
        $user->save(); // Save the user before sending the email
        $user->load('profile'); // Assuming you have a profile relationship
        $profile = new profile();
        $profile->name = $request->input('name');
        $profile->age = $request->input('age');
        $profile->gender = $request->input('gender');
        $profile->position = $request->input('position');
        $profile->department = $request->input('department');
        $profile->phone_number = $request->input('phone_number');
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('images/profile_pictures', 'public');
            $profile->images = $picturePath;
        }
        $profile->user_id = $user->id;
        $user->profile()->save($profile);
        Mail::to($user->email)->send(new ChangePassword($profile, $user->email));
        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('User.view_user')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::check()) {
            return view('User.edit_user')->with('user', $user);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Unable to Update User!');
        }
        $user->profile->name = $request->input('name', $user->profile->name);
        $user->email = $request->input('email', $user->email);
        $user->role = $request->input('role', $user->role);

        $profile = $user->profile;
        $profile->age = $request->input('age', $user->profile->age);
        $profile->gender = $request->input('gender', $user->profile->gender);
        $profile->position = $request->input('position', $profile->position);
        $profile->department = $request->input('department', $profile->department);
        $profile->phone_number = $request->input('phone_number', $profile->phone_number);
        if ($user->save() && $profile->save()) {
            return redirect()->back()->with('success', 'User updated successfully.');
        }
        return redirect()->back()->with('error', 'User update failed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user) {
            $filePath = $user->profile->images;
            $storagePath = str_replace('storage/', '', $filePath);
            if (Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
                $profile = $user->profile;
                if ($profile) {
                    $user->delete();
                    $profile->delete();
                    return redirect()->back()->with('success', 'User deleted successfully!');
                }
            }
            return redirect()->back()->with('error', 'Failed to delete the user.');
        }
        return redirect()->back()->with('errror', 'Failed to delete the user.');
    }
}
