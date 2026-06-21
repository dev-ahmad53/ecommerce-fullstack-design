<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// PUBLIC ROUTES (Without Login - Sab Ke Liye Open)
// ============================================================

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.alternate');

// Product Pages
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart Page
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// ============================================================
// API ROUTES (Public - Sab Ke Liye Open)
// ============================================================

Route::get('/api/products', function() {
    return Product::all();
});

Route::get('/api/products/{id}', function($id) {
    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    return $product;
});

Route::get('/api/products/search/{query}', function($query) {
    return Product::where('name', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%")
                  ->get();
});

// ============================================================
// DASHBOARD ROUTE (Protected - Login Required)
// ============================================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================================
// PROFILE ROUTES (Protected - Login Required)
// ============================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================================
// ADMIN ROUTES
// ============================================================

Route::prefix('admin')->group(function () {
    // Admin Login (Public)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Admin Dashboard + CRUD (Protected)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminProductController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    });
});

// ============================================================
// AUTH ROUTES (Login/Register - Laravel Breeze)
// ============================================================

require __DIR__.'/auth.php';