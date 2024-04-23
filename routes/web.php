<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Setup;
use App\Livewire\Admin\DataSeeder;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CheckSetup;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CKController;
use App\Http\Controllers\Admin\AdministratorController;



Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard.dashboard');
    })->name('admin');
    
    /* Data Seeder  */
    Route::get('/admin/seeder', DataSeeder::class)->name('admin.seeder');
    
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

    /* Warehouse  */
    Route::get('/admin/warehouses', [WarehouseController::class, 'index'])->name('admin.warehouses');
    Route::get('/admin/warehouses/add', [WarehouseController::class, 'add'])->name('admin.warehouses.add');
    Route::get('/admin/warehouses/edit/{id}', [WarehouseController::class, 'edit'])->name('admin.warehouses.edit');

    /* Product  */
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/add', [ProductController::class, 'add'])->name('admin.products.add');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');

    Route::post('/admin/ck-upload-image', [CKController::class, 'uploadImage'])->name('admin.ck-upload-image');

    /* Administrator  */
    Route::get('/admin/administrators', [AdministratorController::class, 'index'])->name('admin.administrators');
    Route::get('/admin/administrators/add', [AdministratorController::class, 'add'])->name('admin.administrators.add');
    Route::get('/admin/administrators/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrators.edit');

    /* Administrator  */
    Route::prefix('admin/inventories')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard.inventory.index');
        })->name('admin.inventories');

        Route::get('/import-of-goods', function () {
            return 'Trang nhập hàng hóa';
        })->name('admin.inventories.import-of-goods');

        Route::get('/goods-rotation', function () {
            return 'Trang luân chuyển';
        })->name('admin.inventories.goods-rotation');
    });
    Route::get('/admin/administrators', [AdministratorController::class, 'index'])->name('admin.administrators');
    Route::get('/admin/administrators/add', [AdministratorController::class, 'add'])->name('admin.administrators.add');
    Route::get('/admin/administrators/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrators.edit');
});

Route::get('/admin/login', Login::class)->middleware([CheckAdminLogin::class])->name('admin.login');
Route::get('/admin/logout', [Login::class, 'handleLogout'])->name('admin.logout');
Route::get('/admin/setup', Setup::class)->middleware([CheckSetup::class])->name('admin.setup');