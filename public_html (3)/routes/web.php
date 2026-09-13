<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionCategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('service-price', [HomeController::class, 'servicePrice'])->name('service-price');
Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('contact-us', [ContactController::class, 'store'])->name('contact-us.store');
Route::get('brands', [HomeController::class, 'brands'])->name('brands');
Route::get('offers', [HomeController::class, 'offers'])->name('offers');
Route::get('insurance', [HomeController::class, 'insurance'])->name('insurance');
Route::get('roadside-assistance', [HomeController::class, 'roadsideAssistance'])->name('roadside-assistance');
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/service/{slug}', [HomeController::class,'serviceDetails'])->name('service.details');
Route::get('/service-category/{slug}', [HomeController::class,'serviceCategoryDetails'])->name('service-category.details');
Route::get('/service-topic/{slug}', [HomeController::class, 'serviceTopic'])->name('service.topic');

Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('book-appointment');
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('book-appointment.store');
Route::get('/book-appointment/{appointment}/confirmation', [AppointmentController::class, 'confirmation'])->name('book-appointment.confirmation');

Route::middleware(['auth'])->group(function () {
    Route::get('/backend', [AdminController::class, 'index'])->name('admindashboard.get');
});

Route::get('/fetch-subcategory/{category_id}',[SubCategoryController::class, 'fetch_subcategory'])->name('fetch-subcategory');

// Route::get('/backend/login', function () {
//     return view('backend.login');
// });
Route::get('backend/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('backend/login', [AuthController::class, 'login'])->name('adminlogin.post');

require __DIR__.'/backend.php';