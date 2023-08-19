<?php

use App\Http\Controllers\Features\EventController;
use App\Http\Controllers\Features\NewsController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
//Route::view('/home', 'home')->name('home');
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'login')->name('login');
        Route::view('/Landing_page', 'welcome')->name('Guest');
        // Route::view('/register','dashboard.user.register')->name('register');
        Route::view('/reset_password', 'dashboard.reset_password')->name('reset_password');
        Route::post('/check_user', [UserController::class, 'Check_User'])->name('check_user');
        Route::view('/request_form', 'guest_layout.request_document')->name('request_form');

    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::get('/email', [UserController::class, 'sendEmail']);
        //View Home Dashboard
        Route::view('/home', 'home.home')->name('home');
        Route::middleware(['redirect_role:Admin'])->group(function () {
            Route::resource('logs',LogsController::class);
// ========== Start of User routes ============================================================================================
            // View Settings
            Route::view('/setting', 'dashboard.user.settings')->name('setting');
            // View Admin Dashboard with Menu
            Route::view('/admin_dashboard', 'dashboard.dashboard')->name('admin_dashboard');
            // View User Table
            Route::view('/user_table', 'tables.user_table')->name('user_table');
            // Get all Users Except it's own Data from Database
            Route::get('/user_table', [UserController::class, 'GetData'])->name('user_table');
            // Get Own Data
            Route::get('/setting', [UserController::class, 'GetOwnData'])->name('setting');
            // Create User
            Route::post('/create_user', [UserController::class, 'CreateUser'])->name('create_user');
            // Update User
            Route::put('/update_user', [UserController::class, 'UpdateUser'])->name('update_user');
            // Delete User
            Route::delete('/delete-user', [UserController::class, 'deleteUser'])->name('delete.user');
            // Update Profile Picture
            Route::put('/update_user_images', [UserController::class, 'updateProfilePicture'])->name('update_profile_picture');
            // Logout User
// ========== End of User routes ============================================================================================


        });


        Route::middleware(['redirect_role:Principal'])->group(function () {
            Route::view('/event_table', 'dashboard.user.admin.admin_tables.events_table')->name('event_table');
            Route::view('/principal_dashboard', 'dashboard.user.principal.principal_dashboard')->name('principal_dashboard');

        });



        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// ========== Start of Events routes ============================================================================================
            //View Events Table
            Route::view('/events_table', 'tables.events_table')->name('events_table');
            //View Events Table
            Route::get('/events_table', [EventController::class, 'index'])->name('events_table');
            // Create Event
            Route::post('/create_event', [EventController::class, 'createEvent'])->name('create_event');
            // Update Event
            Route::put('/update_event', [EventController::class, 'UpdateEvent'])->name('update_event');
            // Delete Event
            Route::delete('/delete_event', [EventController::class, 'DeleteEvent'])->name('delete_event');
// ========== End of News routes ============================================================================================

// ========== Start of News routes ============================================================================================
            Route::resource('news', NewsController::class);
// ========== End of News routes ============================================================================================

        //Route::post('/update_password', [UserController::class, 'Update_Password'])->name('update_password');
    });
});
