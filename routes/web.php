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
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\ImportProductController;
use App\Http\Controllers\Admin\TransferWarehouseController;
use App\Http\Controllers\Admin\LocaleController;
use App\Http\Controllers\Admin\OrderController;


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

    /* Inventory */
    Route::prefix('admin/inventories')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard.inventory.index');
        })->name('admin.inventories');

        Route::get('/import-product', [ImportProductController::class, 'index'])->name('admin.import-product');
        Route::get('/import-product/add', [ImportProductController::class, 'add'])->name('admin.import-product.add');
        Route::get('/import-product/edit/{id}', [ImportProductController::class, 'edit'])->name('admin.import-product.edit');

        Route::get('/transfer-warehouse', [TransferWarehouseController::class, 'index'])->name('admin.transfer-warehouse');
        Route::get('/transfer-warehouse/add', [TransferWarehouseController::class, 'add'])->name('admin.transfer-warehouse.add');
        Route::get('/transfer-warehouse/edit/{id}', [TransferWarehouseController::class, 'edit'])->name('admin.transfer-warehouse.edit');
    });

    /* Audit  */
    Route::get('/admin/audits', [AuditController::class, 'index'])->name('admin.audits');
    Route::get('/admin/audits/detail/{id}', [AuditController::class, 'detail'])->name('admin.audits.detail');

    /* Administrator  */
    Route::get('/admin/administrators', [AdministratorController::class, 'index'])->name('admin.administrators');
    Route::get('/admin/administrators/add', [AdministratorController::class, 'add'])->name('admin.administrators.add');
    Route::get('/admin/administrators/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrators.edit');

    /* Orders  */
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/add', [OrderController::class, 'add'])->name('admin.orders.add');
    Route::get('/admin/orders/edit/{id}', [OrderController::class, 'edit'])->name('admin.orders.edit');
});

Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);
Route::get('/admin/login', Login::class)->middleware([CheckAdminLogin::class])->name('admin.login');
Route::get('/admin/logout', [Login::class, 'handleLogout'])->name('admin.logout');
Route::get('/admin/setup', Setup::class)->middleware([CheckSetup::class])->name('admin.setup');