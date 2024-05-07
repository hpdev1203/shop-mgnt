<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Setup;
use App\Livewire\Admin\DataSeeder;
use App\Livewire\Client\LoginClient;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CheckSetup;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CustomerAuth;
use App\Http\Controllers\LocaleController;
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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SystemInformationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\UserClientController;
use App\Http\Controllers\Client\ChangePasswordController;
use App\Http\Controllers\Client\CollectionController;
use App\Http\Controllers\Client\ShowProductDetailController;




Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
    
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

    /* Orders  */
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/add', [OrderController::class, 'add'])->name('admin.orders.add');
    Route::get('/admin/orders/edit/{id}', [OrderController::class, 'edit'])->name('admin.orders.edit');

    /* Payment Method  */
    Route::get('/admin/payment-methods', [PaymentMethodController::class, 'index'])->name('admin.payment-methods');
    Route::get('/admin/payment-methods/add', [PaymentMethodController::class, 'add'])->name('admin.payment-methods.add');
    Route::get('/admin/payment-methods/edit/{id}', [PaymentMethodController::class, 'edit'])->name('admin.payment-methods.edit');

    /* Audit  */
    Route::get('/admin/audits', [AuditController::class, 'index'])->name('admin.audits');
    Route::get('/admin/audits/detail/{id}', [AuditController::class, 'detail'])->name('admin.audits.detail');

    /* Administrator  */
    Route::get('/admin/administrators', [AdministratorController::class, 'index'])->name('admin.administrators');
    Route::get('/admin/administrators/add', [AdministratorController::class, 'add'])->name('admin.administrators.add');
    Route::get('/admin/administrators/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrators.edit');

    Route::get('/admin/systems', [SystemInformationController::class, 'index'])->name('admin.systems');

    /* Report  */
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/admin/reports/prelim/{id}', [ReportController::class, 'prelim'])->name('admin.reports.prelim');
    Route::get('/admin/reports/inventory', [ReportController::class, 'inventory'])->name('admin.reports.inventory');
    Route::get('/admin/reports/revenue', [ReportController::class, 'revenue'])->name('admin.reports.revenue');
    Route::get('/admin/reports/brand', [ReportController::class, 'brand'])->name('admin.reports.brand');
    Route::get('/admin/reports/customer', [ReportController::class, 'customer'])->name('admin.reports.customer');
});
Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);
Route::get('/admin/login', Login::class)->middleware([CheckAdminLogin::class])->name('admin.login');
Route::get('/admin/logout', [Login::class, 'handleLogout'])->name('admin.logout');
Route::get('/admin/setup', Setup::class)->middleware([CheckSetup::class])->name('admin.setup');



Route::group(['middleware' => [CustomerAuth::class]], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/dang-nhap', LoginClient::class)->name('login');
    Route::get('/logout', [LoginClient::class, 'handleLogout'])->name('logout');
    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
    Route::get('/thong-tin-tai-khoan', [UserClientController::class, 'index'])->name('info_user');
    Route::get('/doi-mat-khau', [ChangePasswordController::class, 'index'])->name('change_password');
});
Route::get('/san-pham/{id}/{slug}', [ClientProductController::class, 'index'])->name('product-detail');
Route::get('/quen-mat-khau', [IndexController::class, 'forgot_password'])->name('forgot_password');

Route::get('/collection/{slug}', [CollectionController::class, 'index'])->name('collection');
