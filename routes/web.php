<?php

use App\Http\Controllers\Features\Organizational_ChartController;
use App\Http\Controllers\Features\AnnouncementController;
use App\Http\Controllers\Features\ApplicantController;
use App\Http\Controllers\Features\HistoryController;
use App\Http\Controllers\Features\CareerController;
use App\Http\Controllers\Guest\DisplayController;
use App\Http\Controllers\Features\EventController;
use App\Http\Controllers\Features\NewsController;
use App\Http\Controllers\Features\AlumniController;
// use App\Http\Controllers\LogsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

// Auth::routes();
// //Route::view('/home', 'home')->name('home');
Route::get('/school-calendar',  [DisplayController::class, 'displayEventsInCalendar'])->name('school-calendar');




Route::get('/change-password/{profile}', [ProfileController::class, 'showChangePasswordForm'])->name('change-password');
Route::put('/ChangePassword/{profile}', [ProfileController::class, 'changePassword'])->name('ChangePassword');






Route::get('/guest_chart', [DisplayController::class, 'displayOrganizationalChart'])->name('guest_chart');
Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::view('/Landing_page', 'welcome')->name('Guest');
    // Route::view('/register','dashboard.user.register')->name('register');
    Route::get('/guest_career', [DisplayController::class, 'displayCareers'])->name('guest_career');
    Route::get('/guest_alumni', [DisplayController::class, 'displayAlumni'])->name('guest_alumni');
    Route::get('/filtered_alumni', [DisplayController::class, 'displayFilteredAlumni'])->name('filtered_alumni');
    // Route::view('/school-calendar', 'School_Calendar.calendar')->name('school-calendar');








    Route::view('/reset_password', 'dashboard.reset_password')->name('reset_password');
    Route::post('/check_user', [ProfileController::class, 'Check_user'])->name('check_user');
    Route::view('/request_form', 'guest_layout.request_document')->name('request_form');


});

Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
    Route::get('/history', [HistoryController::class, 'showHistory']);
    Route::view('/history', 'History.index_history')->name('history');


    Route::get('/email', [UserController::class, 'sendEmail']);
    //View Home Dashboard
    Route::view('/calendar', 'School_Calendar.calendar')->name('calendar');

    Route::view('/home', 'layouts.app')->name('home');
    Route::middleware(['redirect_role:Admin'])->group(function () {

        // ========== Start of User routes ============================================================================================
        // View Settings
        Route::view('/setting', 'dashboard.user.settings')->name('setting');
        // View Admin Dashboard with Menu
        Route::view('/admin_dashboard', 'dashboard.dashboard')->name('admin_dashboard');
        // View User Table
        //Route::view('/user_table', 'tables.user_table')->name('user_table');
        // Get all Users Except it's own Data from Database
        //Route::get('/user_table', [UserController::class, 'GetData'])->name('user_table');
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
    });



    Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');
    // ========== Start of Events routes ============================================================================================
    //View Events Table
    // Route::view('/events_table', 'tables.events_table')->name('events_table');
    // //View Events Table
    // Route::get('/events_table', [EventController::class, 'index'])->name('events_table');
    // // Create Event
    // Route::post('/create_event', [EventController::class, 'createEvent'])->name('create_event');
    // // Update Event
    // Route::put('/update_event', [EventController::class, 'UpdateEvent'])->name('update_event');
    // // Delete Event
    // Route::delete('/delete_event', [EventController::class, 'DeleteEvent'])->name('delete_event');
    // ========== End of News routes ============================================================================================


    Route::resource('users', UserController::class);



    // ========== Start of News routes ============================================================================================
    Route::resource('news', NewsController::class);
    // ========== End of News routes ============================================================================================

    // ========== Start of Announcements routes ============================================================================================
    Route::resource('announcements', AnnouncementController::class);
    // ========== End of Announcements routes ============================================================================================

    // ========== Start of Events routes ============================================================================================
    Route::resource('events', EventController::class);
    // ========== End of Events routes ============================================================================================



    // ========== Start of Career routes ============================================================================================
    Route::resource('careers', CareerController::class);
    // ========== End of Career routes ============================================================================================

    // ========== Start of Alumni routes ============================================================================================
    Route::resource('alumnis', AlumniController::class);
    // ========== End of Alumni routes ============================================================================================
    // ========== Start of Organizational Chart routes ============================================================================================
    Route::resource('organizational_chart', Organizational_ChartController::class);
    // ========== End of Organizational Chart routes ============================================================================================



    //Route::post('/update_password', [UserController::class, 'Update_Password'])->name('update_password');
    // Route::resource('logs', LogsController::class);
});
    // ========== Start of Applicants routes ============================================================================================
    Route::resource('applicants', ApplicantController::class);
    // ========== End of Applicants routes ============================================================================================

    // ========== Start of Request Document routes ============================================================================================
    Route::resource('requests', RequestController::class);
    // ========== End of Request routes ============================================================================================
