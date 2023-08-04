<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\MyCustomEmail;
use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //These is the Controller to Get all data from Database Except it's Own Data
    public function GetData(){
        if (Auth::check()) {
            $userID = Auth::id();
            $profiles = profile::where('id', '<>', $userID)->get();
            return view('dashboard.user.admin.admin_tables.user_table', compact('profiles'));
        } else {
            return redirect()->route('user.login');
        }
    }
    //Get Specific User
    // public function GetUser($id){
    //     if (Auth::check()) {
    //         // Retrieve the user with the given ID along with their profile
    //         $user = User::with('profile')->find($id);
    
    //         if ($user) {
    //             return view('dashboard.user.admin.admin_tables.user_table', compact('user'));
    //         } else {
    //             // User with the given ID not found, handle the error
    //             return redirect()->route('user.notfound');
    //         }
    //     } else {
    //         return redirect()->route('user.login');
    //     }
    // }
    
    // Login
    public function Check_User(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password' => 'required|min:8|max:30'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::guard('web')->attempt($credentials)){
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail','Incorrect Credentials');
        }
    }
    //To Create User
    public function CreateUser(Request $request){
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:Male,Female',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if(!$validate){
            return redirect()->back()->with('fail', 'Unable to Create User!');
        }
        $profile = new profile();
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->age = $request->input('age');
        $profile->gender = $request->input('gender');
        $profile->position = $request->input('position');
        $profile->department = $request->input('department');
        $profile->phone_number = $request->input('phone_number');
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures/profile_pictures', 'public');
            $profile->images = $picturePath;
        }
        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);
        Mail::to($request->email)->send(new MyCustomEmail($token));
        if (count(Mail::failures()) > 0) {
            return redirect()->route('user.home');
        }
        $profile->save();
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();
        return redirect()->back()->with('success', 'Form submitted successfully.');
    }
    //To EDIT User
    public function UpdateUser(Request $request){

    }
    //To Delete User
    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);
        $profile = profile::find($id);
        if ($user && $profile) {
            // Perform the deletion
            $user->delete();
            $profile->delete();
            return redirect()->back()->with('success', 'User deleted successfully!');
        }
    
        return redirect()->back()->with('fail', 'Failed to delete the user.');
    }
}