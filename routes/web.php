<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'total' => \App\Models\Delivery::where('user_id', auth()->id())->count(),
            'pending' => \App\Models\Delivery::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'delivered' => \App\Models\Delivery::where('user_id', auth()->id())->where('status', 'delivered')->count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('deliveries', DeliveryController::class)->only(['index', 'create', 'store', 'show']);
    Route::put('/deliveries/{delivery}/status', [DeliveryController::class, 'updateStatus'])->name('deliveries.update-status');
});
