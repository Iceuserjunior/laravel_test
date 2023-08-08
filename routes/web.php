<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserCardController;
use App\Http\Middleware\IsAdmin;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //user
    Route::get('/user/index', [UserCardController::class, 'index'])->name('user.index');


    //shop
    Route::get('/shoplist', [ProductController::class, 'shopList']);
    Route::get('/removecart/{id}', [ProductController::class, 'removeCart']);

    //cart
    Route::post('/add_to_cart', [ProductController::class, 'addToCart']);
});




Route::middleware('auth', 'is_admin')->group(function () {

    // admin
    Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('adminHome');
    Route::get('/admin/user', [AdminController::class, 'adminUser'])->name('adminUser');


    // peroduct

    Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('Product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('Product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('Product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');

    //user show
    Route::get('/user/{id}/edit', [UserCardController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserCardController::class, 'update'])->name('user.update');
    Route::get('/user/{id}/delete', [UserCardController::class, 'delete'])->name('user.delete');
});



require __DIR__ . '/auth.php';
