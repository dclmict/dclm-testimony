<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimonyFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrusadeTourController;


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
Auth::routes(); // laravel auth routes

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/testimony', [TestimonyFormController::class, 'show'])->name("testimony.show");
Route::post('/testimony', [TestimonyFormController::class, 'store'])->name("testimony.store");

Route::get('/thanks#thanks-section', [TestimonyFormController::class, 'thanks'])->name("testimony.thanks");

//crusade-tour routes
Route::get('/crusade-tour', [CrusadeTourController::class, 'create'])->name("crusade-tour.create");
Route::post('/crusade-tour', [CrusadeTourController::class, 'store'])->name("crusade-tour.store");
Route::get('/crusade-tours', [CrusadeTourController::class, 'index'])->name("crusade-tour.index");



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:Admin']], function () {

    Route::get('/admin', [AdminController::class, 'show'])->name("admin.show");
});

