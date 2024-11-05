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
use App\Http\Controllers\Admin\MacController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\UserClientController;
use App\Http\Controllers\Client\ChangePasswordController;
use App\Http\Controllers\Client\CollectionController;
use App\Http\Controllers\Client\SpotlightController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\OrderSummariesController;
use App\Http\Controllers\Client\OrderHistoryController;
use App\Http\Controllers\Admin\InfoAdminController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Client\BrandController as ClientBrandController;
use App\Http\Controllers\Admin\ArapController;
use App\Http\Controllers\PDFController;



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
    Route::get('/admin/orders/view/{id}', [OrderController::class, 'view'])->name('admin.orders.view');

    /* Payment Method  */
    Route::get('/admin/payment-methods', [PaymentMethodController::class, 'index'])->name('admin.payment-methods');
    Route::get('/admin/payment-methods/add', [PaymentMethodController::class, 'add'])->name('admin.payment-methods.add');
    Route::get('/admin/payment-methods/edit/{id}', [PaymentMethodController::class, 'edit'])->name('admin.payment-methods.edit');

    /* Slider  */
    Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.sliders');
    Route::get('/admin/sliders/add', [SliderController::class, 'add'])->name('admin.sliders.add');
    Route::get('/admin/sliders/edit/{id}', [SliderController::class, 'edit'])->name('admin.sliders.edit');

    /* Audit  */
    Route::get('/admin/audits', [AuditController::class, 'index'])->name('admin.audits');
    Route::get('/admin/audits/detail/{id}', [AuditController::class, 'detail'])->name('admin.audits.detail');

    /* Administrator  */
    Route::get('/admin/administrators', [AdministratorController::class, 'index'])->name('admin.administrators');
    Route::get('/admin/administrators/add', [AdministratorController::class, 'add'])->name('admin.administrators.add');
    Route::get('/admin/administrators/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrators.edit');

    Route::get('/admin/systems', [SystemInformationController::class, 'index'])->name('admin.systems');
    Route::get('/admin/macs', [MacController::class, 'index'])->name('admin.macs');

    /* Report  */
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/admin/reports/prelim/{id}', [ReportController::class, 'prelim'])->name('admin.reports.prelim');
    Route::get('/admin/reports/inventory', [ReportController::class, 'inventory'])->name('admin.reports.inventory');
    Route::get('/admin/reports/revenue', [ReportController::class, 'revenue'])->name('admin.reports.revenue');
    Route::get('/admin/reports/brand', [ReportController::class, 'brand'])->name('admin.reports.brand');
    Route::get('/admin/reports/customer', [ReportController::class, 'customer'])->name('admin.reports.customer');

    /* Admin */
    Route::get('/admin/info_admin', [InfoAdminController::class, 'index'])->name('admin.info_admin');
    Route::get('/admin/change_password', [InfoAdminController::class, 'change_password'])->name('admin.change_password');

    Route::get('/admin/contact', [AdminContactController::class, 'index'])->name('admin.contact');
    Route::get('/admin/contact/edit/{id}', [AdminContactController::class, 'edit'])->name('admin.contact.edit');

    /* ARAPS  */
    Route::get('/admin/araps', [ArapController::class, 'index'])->name('admin.araps');
    Route::get('/admin/araps/view/{id}', [ArapController::class, 'view'])->name('admin.araps.view');

    Route::get('/admin/pdf/{id}', [PDFController::class, 'generatePDF'])->name('admin.pdf');
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
    Route::get('/thanh-toan', [PaymentController::class, 'index'])->name('payment');
    Route::get('/thong-tin-don-hang', [OrderSummariesController::class, 'index'])->name('order_summaries');
    Route::get('/chi-tiet-don-hang/{id}', [OrderHistoryController::class, 'index'])->name('order_history');
    Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
});

Route::get('/san-pham/{id}/{slug}', [ClientProductController::class, 'index'])->name('product-detail');
Route::get('/quen-mat-khau', [IndexController::class, 'forgot_password'])->name('forgot_password');

Route::get('/collection/{slug}', [CollectionController::class, 'index'])->name('collection');
Route::get('/spotlight', [SpotlightController::class, 'index'])->name('spotlight');
Route::get('/spotlight/search', [SpotlightController::class, 'search'])->name('spotlight.search');

Route::get('/nhan-hang/{slug}', [ClientBrandController::class, 'index'])->name('brand');

