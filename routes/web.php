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
use App\Http\Controllers\Admin\ProductController;


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

Route::group(['middleware'=>"auth",'as'=>'admin.','prefix'=>'admin'], function(){

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
Route::get('/',[FrontendController::class,'index'])->name('frontend.index');

//AboutUs
Route::get('/about-us',[FrontendController::class,'about_us'])->name('frontend.aboutus');
Route::get('/contact-us',[FrontendController::class,'contact_us'])->name('frontend.contactus');
