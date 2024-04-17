<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Setup;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CheckSetup;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\WarehouseController;


Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard.dashboard');
    })->name('admin');
    /* Categories  */
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/categories/add', [CategoryController::class, 'add'])->name('admin.categories.add');
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
     /* User  */
     Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
     Route::get('/admin/users/add', [UserController::class, 'add'])->name('admin.users.add');
     Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');

     /* Brands  */
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands');
    Route::get('/admin/brands/add', [BrandController::class, 'add'])->name('admin.brands.add');
    Route::get('/admin/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
    Route::get('/admin/brands/delete/{id}', [BrandController::class, 'delete'])->name('admin.brands.delete');

    /* Warehouse  */
    Route::get('/admin/warehouse', [WarehouseController::class, 'index'])->name('admin.warehouses');
    Route::get('/admin/warehouse/add', [WarehouseController::class, 'add'])->name('admin.warehouses.add');
    Route::get('/admin/warehouse/edit/{id}', [WarehouseController::class, 'edit'])->name('admin.warehouses.edit');
    Route::get('/admin/warehouse/delete/{id}', [WarehouseController::class, 'delete'])->name('admin.warehouses.delete');
});

Route::get('/admin/login', Login::class)->middleware([CheckAdminLogin::class])->name('admin.login');
Route::post('/admin/logout', Login::class)->name('admin.logout');
Route::get('/admin/method', [Login::class, 'handleLogout'])->name('admin.logout');
Route::get('/admin/setup', Setup::class)->middleware([CheckSetup::class])->name('admin.setup');

