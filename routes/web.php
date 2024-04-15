<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Setup;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CheckSetup;
use App\Http\Middleware\CheckAdminLogin;

Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard.dashboard');
    })->name('admin');
});

Route::get('/admin/login', Login::class)->middleware([CheckAdminLogin::class])->name('admin.login');
Route::get('/admin/setup', Setup::class)->middleware([CheckSetup::class])->name('admin.setup');

