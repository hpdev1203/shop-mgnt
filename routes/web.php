<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Setup;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CheckSetup;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Controllers\Admin\CategoryController;


Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard.dashboard');
    })->name('admin');
    /* Categories  */
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/categories/add', [CategoryController::class, 'add'])->name('admin.categories.add');
});

Route::get('/admin/login', Login::class)->middleware([CheckAdminLogin::class])->name('admin.login');
Route::post('/admin/logout', Login::class)->name('admin.logout');
Route::get('/admin/method', [Login::class, 'handleLogout'])->name('admin.logout');
Route::get('/admin/setup', Setup::class)->middleware([CheckSetup::class])->name('admin.setup');

