<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\OrderTrackingController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/',[HomeController::class,'index']);

// Route::get('/aboutus',[AboutUsController::class,'aboutusIndex']);
// Route::get('/careers', [CareersController::class, 'index']);

Route::get('/registration', [AuthController::class, 'showRegister']);
Route::post('/registration', [AuthController::class, 'register'])->name('registration');

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => "auth", 'as' => 'admin.', 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::resource('sub-category', SubCategoryController::class);

    // Family Management
    Route::get('/family', [FamilyController::class, 'index'])->name('family.index');
    Route::post('/family', [FamilyController::class, 'store'])->name('family.store');
    Route::get('/family/edit/{family}', [FamilyController::class, 'edit'])->name('family.edit');
    Route::put('/family/update/{id}', [FamilyController::class, 'update'])->name('family.update');
    Route::delete('/family/delete/{family}', [FamilyController::class, 'destroy'])->name('family.destroy');

    Route::resource('slider', SliderController::class);
    Route::resource('about', AboutUsController::class);
    Route::resource('contact', ContactController::class);

    // Product Routes (ADMIN)
    Route::resource('product', ProductController::class);
    Route::delete('product-image/{id}', [ProductController::class, 'deleteImage'])
        ->name('product.image.delete');
    Route::get('get-subcategories/{id}', [ProductController::class, 'getSubCategories']);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');

    Route::get("/logout",[AuthController::class,'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

// ✅ PRODUCT DETAIL ROUTE (MOVED OUTSIDE ADMIN)
Route::get('/product/{id}', [FrontendController::class, 'productDetail'])
    ->name('product.detail');
Route::get('/family/{id}', [FrontendController::class, 'familyProducts'])
    ->name('family.products');
Route::get('/category/{id}', [FrontendController::class, 'categoryProducts'])
    ->name('category.products');
// Homepage
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

//AboutUs
Route::get('/about-us', [FrontendController::class, 'about_us'])->name('frontend.aboutus');
Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('frontend.contactus');

Route::get('/checkout/{p_id}', [FrontendController::class, 'product_checkout'])->name('frontend.checkout');
Route::post('/checkout/place-order', [FrontendController::class, 'place_order'])->name('frontend.place_order');

Route::get('/order/success/{id}', function ($id) {
    $order = \App\Models\Order::with('customer', 'product')->findOrFail($id);
    return view('frontend.checkout.success', compact('order'));
})->name('frontend.order.success');

Route::post('/checkout/razorpay/create-order', [FrontendController::class, 'razorpay_create_order'])
    ->name('frontend.razorpay.create_order');

Route::post('/checkout/razorpay/verify', [FrontendController::class, 'razorpay_verify_payment'])
    ->name('frontend.razorpay.verify');


Route::get('/track-order', [OrderTrackingController::class, 'index'])
    ->name('frontend.track.order');

Route::post('/track-order', [OrderTrackingController::class, 'track'])
    ->name('frontend.track.search');
