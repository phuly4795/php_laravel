<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\contactController;
use App\Http\Controllers\admin\postController;
use App\Http\Controllers\admin\staff;
use App\Http\Controllers\admin\staffController;
use App\Http\Controllers\admin\indexControllerAdmin;
use App\Http\Controllers\admin\newsletterController;
use App\Http\Controllers\admin\pageController;
use App\Http\Controllers\client\anyController;
use App\Mail\PostEmail;
use App\Models\Invoice;
use App\Notifications\InvoicePaid;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/', [indexControllerAdmin::class, 'home'])->name('dashboard');

    Route::resource('/category', categoryController::class);

    Route::resource('/post', postController::class);
        
    Route::get('profile', [staff::class, 'index'])->name('profile');
    Route::post('profile', [staff::class, 'updateAdmin'])->name('updateAdmin');

Route::middleware(['phanquyen'])->group(function () {
       
    Route::get('/khach-hang', [staffController::class, 'list_user'])->name('list_user');

    Route::resource('/staff', staffController::class);

    Route::resource('/newsletter', newsletterController::class);

    Route::resource('/contact', contactController::class);

    Route::resource('/page', pageController::class);
    
    Route::resource('/comment', CommentController::class);

    Route::get('/system', [indexControllerAdmin::class, 'index'])->name('system');
    
    Route::post('/system', [indexControllerAdmin::class, 'system_post'])->name('system_post');
    
});


});


Route::get('/send_email', [anyController::class , 'email'] );


Route::get('/email/verify', function () {

    return view('auth.verify-email');

})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();
 
    return redirect('/');

})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Đã gửi mã xác thực đến email của bạn!');

})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/',  [anyController::class, 'index']);


Route::post('/autocomplete-ajax', [anyController::class ,'autocomplete']);

Route::post('dang-ky-nhan-tin', [anyController::class ,'subEmail']);

Route::get('/tim-kiem', [anyController::class ,'search']);

Route::get('/lien-he', [anyController::class , 'contact']);

Route::post('/gui-lien-he', [anyController::class ,'subcontact']);

Route::get('/ve-chung-toi', [anyController::class ,'aboutus']);

Route::get('/tags/{tag}', [anyController::class ,'tags']);

Route::get('/cate/{slug}', [anyController::class ,'pageCate']);

Route::get('/cate/{slug1}/{slug}.html', [anyController::class ,'detail']);

Route::post('/tin-yeu-thich', [anyController::class ,'addwishlist']);

Route::post('/xoa-tin-yeu-thich', [anyController::class ,'delewishlist']);

Route::post('/thong-tin-nguoi-dung', [anyController::class ,'updateProfile'])->name('updateProfile');


Route::post('/load-binh-luan', [anyController::class ,'loadComment']);

Route::post('/them-binh-luan', [anyController::class ,'addComment']);

Route::get('/tra-loi-binh-luan', [anyController::class ,'addRepComment']);
Route::post('/tra-loi-binh-luan', [anyController::class ,'addRepComment']);


Route::post('/tin-yeu-thich', [anyController::class ,'addwishlist']);


Route::middleware(['auth'])->group(function(){  

    Route::get('/thong-tin-nguoi-dung', [anyController::class, 'profile']);
    Route::get('/tin-yeu-thich', [anyController::class ,'wishlist']);
    
});

require __DIR__.'/auth.php';
