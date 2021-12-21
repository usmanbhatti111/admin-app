<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StripeController;

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
  return view('home');
});
Route::get('/dashboard', function () {
  return view('Admin.home');
});

Route::get('stripe', [StripeController::class, 'index']);
Route::post('makePayment', [StripeController::class, 'makePayment']);


Route::get('stripe1', [StripeController::class,'stripe']);
Route::post('payment', [StripeController::class,'payStripe']);



Route::post('payment-process', [StripeController::class, 'process']);

Route::get('view_all', [NotificationController::class, 'viewAll']);

Route::get('pdfReader', [UserController::class, 'pdfReader']);
Route::post('send_pdf', [UserController::class, 'uploadPdf']);

Route::get('notification', [NotificationController::class, 'TicketNotification']);
Route::post('mark-as-read', [NotificationController::class, 'markNotification']);


// Route::group(['middleware' => 'admin'], function (){
//  Route::get('tickets', [TicketsController::class,'index']);
//  Route::post('close_ticket/{ticket_id}', [TicketsController::class,'close']);

// });
Route::get('/send-notification', [NotificationController::class, 'sendOfferNotification']);
Route::get('new-ticket', [TicketsController::class, 'create']);
Route::post('new-ticket', [TicketsController::class, 'store']);
Route::get('my_tickets', [TicketsController::class, 'userTickets']);
Route::get('tickets/{ticket_id}', [TicketsController::class, 'show']);
Route::post('comment', [CommentsController::class, 'postComment']);

Route::resource('user', UserController::class);

Route::get('tickets', [TicketsController::class, 'index']);
Route::post('comment', [CommentsController::class, 'postComment']);

Route::group(['middleware' => ['role:User']], function () {




});

Route::group(['middleware' => ['role:Admin']], function () {

  Route::resource('role', RoleController::class);
  Route::resource('custom', CustomController::class);
  Route::post('user/update', [UserController::class, 'update']);
  Route::resource('permission', PermissionController::class);
  Route::post('close_ticket/{ticket_id}', [TicketsController::class, 'close']);
});

require __DIR__ . '/auth.php';
