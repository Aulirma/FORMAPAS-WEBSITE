<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PendaftarKKNController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddPengurusController;
use App\Http\Controllers\HalamanPengurusController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\AdminSeleksiController;
use Illuminate\Support\Facades\DB;

/*-----------------------
    WEB ROUTES
-----------------------*/ 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/index', [\App\Http\Controllers\NewsController::class, 'home'])->name('home');
    Route::get('/berita', [\App\Http\Controllers\NewsController::class, 'home'])->name('berita');

Route::get('/pengurus', function () {
    return view('pengurus');
})->name('pengurus');

Route::get('/kkn', function () {
    return view('kkn');
})->name('kkn');

Route::get('/toko', function () {
    $products = DB::table('product')->orderBy('ID_PRODUCT', 'desc')->get();
    return view('merch', compact('products'));
})->name('toko');
    Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/*-----------------------
    USER AUTH ROUTES
-----------------------*/
use App\Http\Controllers\Auth\LoginController;
Route::get('/auth', function () {
    return view('auth');
})->name('auth');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    //  save mbti
    Route::post('/kkn/mbti', [AuthController::class, 'saveMbti'])
        ->name('kkn.mbti.save');

    // halaman setting akun
    Route::get('/user/setting', function () {
        return view('user.setting');
    })->name('user.setting');

    // status KKN
    Route::get('/user/daftarKKN', 
            [PendaftarKKNController::class, 'index']
        )->name('user.daftar');

        Route::post('/user/daftarKKN', 
            [PendaftarKKNController::class, 'store']
        )->name('user.daftar.submit');

    // status merchandise
    Route::get('/user/merch',
            [UsersController::class, 'merchHistory']
        )->name('user.merch');

});

Route::middleware('auth')->group(function () {

        Route::put('/user/update-password', 
            [UsersController::class, 'updatePassword']
        )->name('user.update.pw');

        Route::post('/user/update-email', 
            [UsersController::class, 'updateEmail']
        )->name('user.update.email');

        Route::delete('/delete-account', 
            [UsersController::class, 'deleteAccount']
        )->name('user.delete');
    });

/* -----------------------
    ADMIN ROUTES
-----------------------*/
Route::prefix('admin')->group(function () {
    
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/login', [AdminController::class, 'loginPage'])->name('admin.loginPage');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // KKN
    Route::get('/admin/kkn', [AdminController::class, 'kkn'])->name('admin.kkn');
    Route::post('/admin/kkn/{id}/approve', [AdminController::class, 'approveKKN'])->name('admin.kkn.approve');
    Route::post('/admin/kkn/{id}/reject', [AdminController::class, 'rejectKKN'])->name('admin.kkn.reject');

    // NEWS
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/news', [NewsController::class, 'create'])->name('news.create');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Formapals
    Route::get('/formapals', [AdminController::class, 'formapals'])->name('formapals');
    Route::delete('/formapals/{nik}', [AdminController::class, 'deleteFormapals'])->name('formapals.delete');

    // Merch
    Route::get('/admin/merch', [AdminController::class, 'merch'])->name('admin.merch');
    Route::post('/admin/merch/store', [AdminController::class, 'storeMerch']);
    Route::delete('/admin/merch/delete/{id}',[AdminController::class, 'deleteMerch'])->name('admin.merch.delete');

    Route::get('/merch', [AdminController::class, 'merch'])->name('admin.merch');
    Route::post('/merch', [AdminController::class, 'storeMerch'])->name('admin.merch.store');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
    Route::get('/orders/{trxId}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::post('/orders/{trxId}/approve', [AdminController::class, 'approveOrder'])->name('admin.orders.approve');
    Route::post('/admin/orders/{trxId}/reject', [AdminController::class, 'rejectOrder'])->name('admin.orders.reject');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pengurus', AddPengurusController::class);
});

// Route::get('/', [HalamanPengurusController::class, 'index'])->name('home');
Route::get('/pengurus', [HalamanPengurusController::class, 'index'])->name('pengurus');

// SELEKSI ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-seleksi', [SeleksiController::class, 'index'])->name('seleksi.dashboard');
    Route::post('/seleksi/tahap1', [SeleksiController::class, 'storeTahap1'])->name('seleksi.tahap1');
    Route::post('/seleksi/tahap2', [SeleksiController::class, 'storeTahap2'])->name('seleksi.tahap2');
    Route::post('/seleksi/tahap3', [SeleksiController::class, 'storeTahap3'])->name('seleksi.tahap3');
});

Route::put('/admin/seleksi/{id}/update', [AdminSeleksiController::class, 'updateSeleksi'])->name('admin.seleksi.update');