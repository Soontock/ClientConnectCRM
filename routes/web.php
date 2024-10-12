<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketingController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [DashboardController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('user', [UserController::class,'index'])->name('user.index');
        Route::get('/user/create', [UserController::class,'create'])->name('user.create');
        Route::post('/user', [UserController::class,'store'])->name('user.store');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
       
    });

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/createCustomer', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/interactions', [InteractionController::class,'index'])->name('interactions.index');
    Route::get('/createInteractions',[InteractionController::class,'create'])->name('interactions.create');
    Route::post('/interactions', [InteractionController::class,'store'])->name('interactions.store');
    Route::get('/interactions/{id}/edit', [InteractionController::class, 'edit'])->name('interactions.edit');
    Route::put('/interactions/{id}', [InteractionController::class, 'update'])->name('interactions.update');
    Route::delete('/interactions/{id}', [InteractionController::class,'destroy'])->name('interactions.destroy');

    Route::get('/tickets', [TicketingController::class, 'index'])->name('tickets.index');
    Route::get('/search-customer', [TicketingController::class, 'searchByEmail'])->name('tickets.searchByEmail');
    Route::post('/tickets/assign', [TicketingController::class, 'assign'])->name('tickets.assign');

    Route::get('/tickets/create', [TicketingController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketingController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}/edit', [TicketingController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{id}', [TicketingController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{id}', [TicketingController::class, 'destroy'])->name('tickets.destroy');

    Route::get('/reports',[ReportController::class,'index'])->name('reports.index');
    Route::get('/reports/customers/csv', [ReportController::class, 'exportCustomersCSV'])->name('reports.customers.csv');
    Route::get('/reports/tickets/csv', [ReportController::class, 'exportTicketsCSV'])->name('reports.tickets.csv');
    Route::get('/reports/customers/pdf', [ReportController::class, 'exportCustomersPDF'])->name('reports.customers.pdf');
    Route::get('/reports/tickets/pdf', [ReportController::class, 'exportTicketsPDF'])->name('reports.tickets.pdf');

});

require __DIR__.'/auth.php';
