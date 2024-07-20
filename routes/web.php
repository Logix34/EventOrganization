<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app', function () {
    return view('admin/includes/layout/app');
});

Route::get('/login',[AdminController::class,'getLogin'])->name('login');
Route::post('/verify-login',[AdminController::class,'postLogin']);
Route::post('/submit-events/form', [EventController::class,'submitEventForm']);
Route::put('/submit-Profile/form', [AdminController::class,'updateProfile'])->name('admin.updateProfile');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::group(['middleware' => 'auth'], function () {


//////////////////////////.........Users section......../////////////////////
    Route::get('/admin/user', [AdminController::class,'getUser']);

    Route::get('/get-users/list',[AdminController::class,'getUsersList']);
    Route::get('/admin/user-add',[AdminController::class,'getAdd']);
    Route::get('/User/profile', [AdminController::class,'editprofile'])->name('admin.profile');
//////////////////////////.......Booking Sections.......///////////////////////
    Route::get('/admin/bookings', [AdminController::class,'booking']);
    Route::get('/admin/Add-booking', [AdminController::class,'addBooking']);
    Route::get('/get-booking/list', [AdminController::class,'getBookingList']);
//////////////////////////........Events Section....//////////////////////////
    Route::get('/admin/events', [EventController::class,'getEvent']);
    Route::get('/get-events/list', [EventController::class,'getListEvents']);
    Route::get('/admin/Add-Event',[EventController::class,'addEvent']);
    Route::get('/events/edit/{id}', [EventController::class,'editEvent']);
    Route::get('/events/delete/{id}',[EventController::class,'deleteEvent']);
////////////////////////..........Participants Section.....//////////////
        Route::get('/admin/participants', [AdminController::class,'getParticipants']);

});
Route::get('/logout', [AdminController::class,'logoutUser']);


Route::get('/payment_step',[PaymentController::class,'index'])->name('payment');
Route::post('/send_payment',[PaymentController::class,'create_payment'])->name('SendPayment');
