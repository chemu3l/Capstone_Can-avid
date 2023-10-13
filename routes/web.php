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
use App\Http\Controllers\Features\DocumentController;
use App\Http\Controllers\Features\FeedbackController;
use App\Http\Controllers\Features\LogsController;
use App\Http\Controllers\FilterTableController;
// use App\Http\Controllers\LogsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/school-calendar',  [DisplayController::class, 'displayEventsInCalendar'])->name('school-calendar');
Route::get('/change-password/{profile}', [ProfileController::class, 'showChangePasswordForm'])->name('change-password');
Route::put('/ChangePassword/{profile}', [ProfileController::class, 'changePassword'])->name('ChangePassword');
Route::get('/guest_chart', [DisplayController::class, 'displayOrganizationalChart'])->name('guest_chart');
Route::get('/guestannouncement', [DisplayController::class, 'guestannouncement'])->name('guestannouncement');
Route::get('/guest_news', [DisplayController::class, 'guestNews'])->name('guest_news');
Route::get('/admission', [DisplayController::class, 'displayAdmission'])->name('admission');

Route::get('/forget-password/{email}', [ProfileController::class, 'showForgetPasswordForm'])->name('forget-password');
Route::post('/ForgetPassword', [ProfileController::class, 'forgetPassword'])->name('ForgetPassword');
Route::get('/sendEmail', [ProfileController::class, 'getEmail'])->name('sendEmail');
Route::put('/changeForgetPassword/{email}', [ProfileController::class, 'changeForgetPassword'])->name('changeForgetPassword');



Route::get('/guest_events', [DisplayController::class, 'displayEvents'])->name('display_events');
Route::get('/show_event/{event}', [DisplayController::class, 'showEvent'])->name('show_event');
Route::get('/show_news/{news_id}', [DisplayController::class, 'showNews'])->name('show_news');

Route::post('/departments/filter', [DisplayController::class, 'filterByDepartment'])->name('departments.filter');
Route::view('/login', 'login')->name('login');
Route::view('/Landing_page', 'welcome')->name('Guest');
Route::get('/guest_career', [DisplayController::class, 'displayCareers'])->name('guest_career');
Route::get('/departments/filter', [DisplayController::class, 'displayDepartment'])->name('display_departments');
Route::view('/reset_password', 'dashboard.reset_password')->name('reset_password');
Route::post('/check_user', [ProfileController::class, 'Check_user'])->name('check_user');
Route::view('/request_form', 'guest_layout.request_document')->name('request_form');
Route::view('/', 'layouts.homePage')->name('HomePage');

Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
    Route::view('/home', 'layouts.app')->name('home');
    Route::get('/announcements/search', [FilterTableController::class, 'searchAnnouncement'])->name('announcement_Filter');
    Route::get('/applicants/search', [FilterTableController::class, 'searchApplicant'])->name('applicant_Filter');
    Route::get('/careers/search', [FilterTableController::class, 'searchCareer'])->name('career_Filter');
    Route::get('/users/search', [FilterTableController::class, 'searchUser'])->name('user_Filter');

    Route::get('/requested/search', [FilterTableController::class, 'searchDocument'])->name('requested_Filter');
    Route::get('/event/search', [FilterTableController::class, 'searchEvent'])->name('event_Filter');
    Route::get('/logs/search', [FilterTableController::class, 'searchLogs'])->name('logs_Filter');
    Route::get('/news/search', [FilterTableController::class, 'searchNews'])->name('news_Filter');
    Route::get('/history', [HistoryController::class, 'showHistory'])->name('history');
    Route::get('/sidenav', [ProfileController::class, 'SidenavShow'])->name('sidenav');
    Route::view('/calendar', 'School_Calendar.calendar')->name('calendar');
    Route::view('/setting', 'dashboard.user.settings')->name('setting');
    Route::view('/admin_dashboard', 'dashboard.dashboard')->name('admin_dashboard');
    Route::get('/setting', [ProfileController::class, 'GetOwnData'])->name('setting');
    Route::put('/update_user', [ProfileController::class, 'UpdateUser'])->name('update_user');
    Route::put('/update_user_images', [ProfileController::class, 'updateProfilePicture'])->name('update_profile_picture');

    Route::middleware(['redirect_role:Admin'])->group(function () {
        // View Admin Dashboard with Menu
        Route::view('/admin_dashboard', 'dashboard.dashboard')->name('admin_dashboard');
    });



    Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');
    // ========== Start of News routes ============================================================================================
    Route::resource('news', NewsController::class);
    // ========== End of News routes ============================================================================================

    // ========== Start of Announcements routes ============================================================================================
    Route::resource('announcements', AnnouncementController::class);
    // ========== End of Announcements routes ============================================================================================

    // ========== Start of History/Logs routes ============================================================================================
    Route::resource('logs', LogsController::class);
    // ========== End of History/Logs routes ============================================================================================

    // ========== Start of Events routes ============================================================================================
    Route::resource('events', EventController::class);
    // ========== End of Events routes ============================================================================================


    // ========== Start of Career routes ============================================================================================
    Route::resource('careers', CareerController::class);
    // ========== End of Career routes ============================================================================================

    // ========== Start of Organizational Chart routes ============================================================================================
    Route::resource('organizational_chart', Organizational_ChartController::class);
    // ========== End of Organizational Chart routes ============================================================================================

    //Route::post('/update_password', [UserController::class, 'Update_Password'])->name('update_password');
    // Route::resource('logs', LogsController::class);
});
// ========== Start of Request Document routes ============================================================================================
Route::resource('users', UserController::class);
// ========== End of Request routes ============================================================================================
// ========== Start of Applicants routes ============================================================================================
Route::resource('applicants', ApplicantController::class);
// ========== End of Applicants routes ============================================================================================
// ========== Start of Feedback routes ============================================================================================
Route::resource('feedback', FeedbackController::class);
// ========== End of Feedback routes ============================================================================================
// ========== Start of Request Document routes ============================================================================================
Route::resource('requests', DocumentController::class);
// ========== End of Request routes ============================================================================================

Route::get('page_not_found', [DisplayController::class, 'pageNotFound'])->name('page_not_found');
