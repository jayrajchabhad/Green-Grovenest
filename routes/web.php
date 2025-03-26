<?php

use App\Http\Controllers\Admin\ProductRecommendationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CouponsOfferController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Middleware\Adminmiddleware;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



use Illuminate\Foundation\Auth\EmailVerificationRequest;

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



Auth::routes(['verify' => true]);

// Route::middleware(['auth'])->group(function () {
//     Route::post('/email/verification-notification', function (Request $request) {
//         if ($request->user()->hasVerifiedEmail()) {
//             return redirect('/home')->with('message', 'Your email is already verified.');
//         }
//         $request->user()->sendEmailVerificationNotification();
//         return back()->with('resent', true);
//     })->name('verification.resend');
// });

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    }
    return back()->withErrors(['error' => 'User not authenticated']);
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::middleware(['auth', 'verified'])->get('/home', function () {
    return view('home');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::find($id);

    if (!$user) {
        return redirect('/login')->with('error', 'User not found.');
    }

    if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return redirect('/login')->with('error', 'Invalid verification link.');
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    return redirect('/login')->with('success', 'Your email has been verified! You can now log in.');
})->middleware(['signed'])->name('verification.verify');

    

Route::get('/verify', function () {
    return view('auth.verify');
});

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {

        Route::get('/',  'index');
        Route::get('/collections', 'categories');
        Route::get('/electronics',  'electronics_collections');
        Route::get('/sports',  'sports_collections');
        Route::get('/collections/{category_slug}', 'products');
        Route::get('/collections/{category_slug}/{product_slug}', 'productsview');
        Route::get('/new-arrivals','newArrivals');
        Route::get('/featured-product','featuredproduct');
        Route::get('search','searchproduct');
        Route::get('about-us','about');
        Route::get('contact-us','contact');
        Route::post('contact-us','contactusUpdate');

});

Route::middleware(['auth'])->group(function()
{

    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class,'index']); 
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class,'index']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class,'index']);
    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class,'index']);
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class,'show']);
    Route::get('profile', [App\Http\Controllers\Frontend\UserController::class,'index']);
    Route::get('edit-profile', [App\Http\Controllers\Frontend\UserController::class,'edit']);
    Route::post('profile',[App\Http\Controllers\Frontend\UserController::class,'updateUserDetail']);
    Route::get('change-password', [App\Http\Controllers\Frontend\UserController::class,'passwordCreate']);
    Route::post('change-password',[App\Http\Controllers\Frontend\UserController::class,'changePassword']);

});
 
Route::get('thank-you',  [App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {

    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index']);
    Route::get( 'settings',[App\Http\Controllers\Admin\SettingController::class,'index']);
    Route::post('settings',[App\Http\Controllers\Admin\SettingController::class,'store']);


    Route::controller(App\Http\Controllers\Admin\ContacController::class)->group(function () {

        Route::get('contactUs','index');
        Route::get('contactUs/{contectUs}/delete','destroy');
        Route::delete('contactUs/{contectUs}/delete',  'destroy')->name('contact.destroy');
        Route::get('contactUs/{contectUs}/reply','reply');
        Route::post('contact/reply/{contactdata_id}','replymail');


    });

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('slider','index');
        Route::get('slider/create','create'); 
        Route::post('slider/create', 'store');
        Route::get('slider/{sliders}/edit','edit');
        Route::put('slider/{sliders}','update');
        Route::get('slider/{sliders}/delete','destroy');

        Route::delete('admin/slider/{slider}', 'destroy')->name('slider.destroy');



    });

    //category routes
     
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('category/C-create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category_id}/edit',  'edit');
        Route::put('/category/{category_id}',  'update');
        Route::delete('/admin/{category}', 'destroy');

    });

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/P-create','create');
        Route::post('/products','store');
        Route::get('/products/{product}/edit','edit');
        Route::put('/products/{product}','update');
        Route::delete('products/{product_id}/delete', 'destroy')->name('admin.products.destroy');
        Route::get('product-image/{product_image_id}/delete','destroyImage');
        Route::post('product-color/{prod_color_id}','upadateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete','deleteProdColor');
        
    });
 

    Route::get('/brands',  App\Http\Livewire\Admin\Brand\Index::class);

    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create','create');
        Route::post('/colors/create','store');
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color_id}','update');
        Route::get('/colors/{color_id}/delete','destroy');
        Route::delete('/colors/{color_id}/delete', 'destroy')->name('admin.colors.destroy');

        
    });


    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/ordersdetail/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');
        Route::get('/invoice/{orderId}' ,'viewInvoice');
        Route::get('/invoice/{orderId}/generate' ,'generateInvoice');
        Route::get('/invoice/{order_id}/mail','mailInvoice');   
         
    });

    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/add_user', 'create');
        Route::post('/users','store'); 
        Route::get('/users/{user_id}/edit','edit'); 
        Route::put('users/{user_id}','update');
        Route::get('users/{user_id}/delete','destroy');
        Route::delete('admin/users/{user}', 'destroy')->name('users.destroy');


    });

    Route::controller(ProductRecommendationController::class)->group(function(){
        Route::get('recommendations', 'index');
        Route::get('recommendationCreate', 'create');
        Route::post('recommendations', 'store');
        Route::get('recommendationEdit/{id}', 'edit');
        Route::put('recommendationEdit/{id}', 'update');
        Route::delete('recommendationDelete/{id}', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\CouponsOfferController::class)->group(function () {
        
        Route::get('coupons', 'index');
        Route::get('couponsEdit/{coupons}', 'edit');
        Route::put('couponsEdit/{coupons}', 'update');
        Route::get('couponscreate', 'create');
        Route::post('coupons',  'store');
        Route::delete('couponsDelete/{coupons}', 'destroy');


    });

    Route::controller(App\Http\Controllers\Admin\ReviewController::class)->group(function () {


        Route::get('review','index');   
        Route::post('/admin/reviews/{id}/approve',  'approve')->name('admin.reviews.approve');
        Route::post('/admin/reviews/{id}/disapprove', 'disapprove')->name('admin.reviews.disapprove');

        Route::delete('/admin/reviews/{id}',  'destroy')->name('admin.reviews.destroy');





    });


});