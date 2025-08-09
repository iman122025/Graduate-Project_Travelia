<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\DaysController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingAdminController;



///////////////////////////////////////////////////////////////////////////////////////////////

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

///////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    /////////////////////////////

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    /////////////////////////////

    Route::get('/admins', [AdminsController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminsController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminsController::class, 'store'])->name('admins.store');
    Route::get('/admins/{id}/edit', [AdminsController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{id}', [AdminsController::class, 'update'])->name('admins.update');
    Route::delete('/admins/{id}', [AdminsController::class, 'destroy'])->name('admins.destroy');

    /////////////////////////////

    Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');

    Route::get('/customers/notes', [CustomersController::class, 'index_notes'])->name('customers_notes.index');

    /////////////////////////////

    Route::get('/cities', [CitiesController::class, 'index'])->name('cities.index');
    Route::get('/cities/create', [CitiesController::class, 'create'])->name('cities.create');
    Route::post('/cities', [CitiesController::class, 'store'])->name('cities.store');
    Route::get('/cities/{id}/edit', [CitiesController::class, 'edit'])->name('cities.edit');
    Route::put('/cities/{id}', [CitiesController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{id}', [CitiesController::class, 'destroy'])->name('cities.destroy');

    /////////////////////////////

    Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/create', [HotelsController::class, 'create'])->name('hotels.create');
    Route::post('/hotels', [HotelsController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/{id}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
    Route::put('/hotels/{id}', [HotelsController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{id}', [HotelsController::class, 'destroy'])->name('hotels.destroy');

    Route::delete('/hotels/deleteImage/{id}', [HotelsController::class, 'deleteImage'])->name('hotels.deleteImage');

    /////////////////////////////

    Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{id}', [BookingsController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/bookings/{id}/details', [BookingsController::class, 'details'])->name('bookings.details');

    /////////////////////////////

    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
    Route::get('/tags/{id}/edit', [TagsController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{id}', [TagsController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');

    /////////////////////////////

    Route::get('/days', [DaysController::class, 'index'])->name('days.index');
    Route::get('/days/create', [DaysController::class, 'create'])->name('days.create');
    Route::post('/days', [DaysController::class, 'store'])->name('days.store');
    Route::get('/days/{id}/edit', [DaysController::class, 'edit'])->name('days.edit');
    Route::put('/days/update_day/{id}', [DaysController::class, 'update'])->name('days.update');
    Route::delete('/days/{id}', [DaysController::class, 'destroy'])->name('days.destroy');

    /////////////////////////////

});

///////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('')->name('site.')->group(function () {

    Route::get('/', [SiteController::class, 'index'])->name('home'); // home

    Route::get('/about-us', [SiteController::class, 'aboutus'])->name('aboutus');

    Route::get('/account', [SiteController::class, 'account'])->name('account');

    Route::get('/city/{id}/hotels', [SiteController::class, 'city_hotels'])->name('city_hotels');

    Route::get('/planning', [SiteController::class, 'planning'])->name('planning');

    Route::match(['get', 'post'], '/plan', [SiteController::class, 'plan'])->name('plan'); ///// test
    // Route::post('/plan', [SiteController::class, 'plan'])->name('plan'); /////

    Route::get('/booking/{id}', [SiteController::class, 'booking'])->name('booking');

    Route::post('/save_booking', [SiteController::class, 'save_booking'])->name('save_booking');

    Route::get('/hotel/{id}', [SiteController::class, 'hotel'])->name('hotel');

    Route::get('/planning-process/{id}', [SiteController::class, 'planning_process'])->name('planning-process');

    Route::match(['get', 'post'], '/plan-ready', [SiteController::class, 'plan_ready'])->name('plan-ready'); ///// test
    // Route::get('/plan-ready', [SiteController::class, 'plan_ready'])->name('plan-ready'); /////

    Route::match(['get', 'post'], '/plan_booking', [SiteController::class, 'plan_booking'])->name('plan_booking'); ///// test
    // Route::post('/plan-booking', [SiteController::class, 'plan_booking'])->name('plan_booking'); /////

    Route::post('/feedback', [SiteController::class, 'feedback_store'])->name('feedback.store');

});

///////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('')->name('profile.')->group(function () {

    Route::get('/edit-info', [SiteController::class, 'edit_info'])->name('edit_info');
    Route::put('/update-customer/{id}', [SiteController::class, 'update_customer'])->name('update_customer');

    Route::get('/edit-password', [SiteController::class, 'edit_password'])->name('edit_password');
    Route::put('/update-password/{id}', [SiteController::class, 'update_password'])->name('update_password');

});

///////////////////////////////////////////////////////////////////////////////////////////////

require __DIR__.'/auth.php';

