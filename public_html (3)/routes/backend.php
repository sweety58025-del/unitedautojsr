<?php

use App\Http\Controllers\AboutWebsiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PermissionCategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicePriceController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('backend')->group(function () {

    Route::get('/setting', [AdminController::class, 'setting'])->name('admin.setting');
    Route::post('/store-company', [AdminController::class, 'storeCompany'])->name('admin.store-company');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');

    Route::get('/roles', [PermissionController::class, 'roles'])->name('roles');
    Route::post('/roles/store', [PermissionController::class, 'roles_store'])->name('roles.store');
    Route::get('/roles/{roles_id}/edit', [PermissionController::class, 'edit_roles'])->name('roles.edit');
    Route::post('/roles/{roles_id}/update', [PermissionController::class, 'update_roles'])->name('roles.update');
    Route::get('/roles/{roles_id}/destroy', [PermissionController::class, 'destroy_roles'])->name('roles.destroy');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee/store', [EmployeeController::class, 'employee_store'])->name('employee.store');
    Route::get('/employee/{employee_id}/edit', [EmployeeController::class, 'edit_employee'])->name('employee.edit');
    Route::post('/employee/{employee_id}/update', [EmployeeController::class, 'update_employee'])->name('employee.update');
    Route::get('/employee/{employee_id}/destroy', [EmployeeController::class, 'destroy_employee'])->name('employee.destroy');

    Route::get('/permission', [PermissionController::class, 'permission'])->name('permission');
    Route::post('/permission/store', [PermissionController::class, 'permission_store'])->name('permission.store');

    Route::resource('/permission-categories',PermissionCategoryController::class);

    // Service Management route
    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::resource('services',ServiceController::class);

    // About Website Management route
    Route::get('/website-content/about-website', [AboutWebsiteController::class, 'index'])->name('about_website.index');
    Route::post('/website-content/about-website/store', [AboutWebsiteController::class, 'storeOrUpdate'])->name('about_website.store');
    Route::get('/website-content/hero-banner', [AboutWebsiteController::class, 'hero_banner'])->name('website_content.hero_banner');
    Route::post('/website-content/hero-banner/store', [AboutWebsiteController::class, 'heroBannerStore'])->name('hero-banner.store');

    Route::resource('service-price', ServicePriceController::class);

    Route::get('brands',[BrandController::class,'index'])->name('brands.index');
    Route::post('brands/store',[BrandController::class,'store'])->name('brands.store');
    Route::get('brands/edit/{id}',[BrandController::class,'edit'])->name('brands.edit');
    Route::post('brands/update/{id}',[BrandController::class,'update'])->name('brands.update');
    Route::delete('brands/delete/{id}',[BrandController::class,'destroy'])->name('brands.delete');

    Route::get('gallery',[GalleryController::class,'index'])->name('gallery.index');
    Route::post('gallery/store',[GalleryController::class,'store'])->name('gallery.store');
    Route::get('gallery/edit/{id}',[GalleryController::class,'edit'])->name('gallery.edit');
    Route::post('gallery/update/{id}',[GalleryController::class,'update'])->name('gallery.update');
    Route::delete('gallery/delete/{id}',[GalleryController::class,'destroy'])->name('gallery.delete');

    Route::get('testimonial',[TestimonialController::class,'index'])->name('testimonial.index');
    Route::post('testimonial/store',[TestimonialController::class,'store'])->name('testimonial.store');
    Route::get('testimonial/edit/{id}',[TestimonialController::class,'edit'])->name('testimonial.edit');
    Route::post('testimonial/update/{id}',[TestimonialController::class,'update'])->name('testimonial.update');
    Route::get('testimonial/delete/{id}',[TestimonialController::class,'destroy'])->name('testimonial.delete');

    Route::get('appointments',[AppointmentController::class,'index'])->name('appointment.index');
    Route::post('appointments/{id}/status',[AppointmentController::class,'updateStatus'])->name('appointment.status');
    Route::post('appointments/{id}/delete',[AppointmentController::class,'destroy'])->name('appointment.delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.backend');

});


