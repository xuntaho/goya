<?php

use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\BlogChiTietController;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\CheckoutController;
use App\Http\Controllers\clients\ChiTietToursController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\DangKyController;
use App\Http\Controllers\clients\HuongDanVienController;
use App\Http\Controllers\clients\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\InformationController;
use App\Http\Controllers\clients\LoginController;

use App\Http\Controllers\clients\NoidenController;
use App\Http\Controllers\clients\TourBookedController;
use App\Http\Controllers\clients\ToursController;

use App\Http\Controllers\admin\ToursManagementController;
use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AdminManagementController;
use App\Http\Controllers\admin\BookingManagementController;
use App\Http\Controllers\admin\UserManagementController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/chitiet_tour/{id}', [ChiTietToursController::class, 'index'])->name('chitiet_tour');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/noiden', [NoidenController::class, 'index'])->name('noiden');
Route::get('/huongdanvien', [HuongDanVienController::class, 'index'])->name('huongdanvien');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog_chitiet', [BlogChiTietController::class, 'index'])->name('blog_chitiet');
Route::get('/search', [SearchController::class, 'index'])->name('search');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user-login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/dangky', [LoginController::class, 'showRegister'])->name('dangky'); 
Route::post('/dangky', [LoginController::class, 'dangky'])->name('dangky.post');

Route::get('/active-account/{token}', [LoginController::class, 'activateAccount'])
    ->name('activate.account');

//xu ly tour
Route::get('/tours', [ToursController::class, 'index'])->name('tours');
Route::get('/filter-tours', [ToursController::class, 'filterTours'])->name('filter-tours');

// thong tin ca nhan
Route::get('/infor', [InformationController::class, 'index'])->name('infor');
Route::post('/infor', [InformationController::class, 'update'])->name('update-infor');
// Cập nhật mật khẩu
Route::post('/update-password', [InformationController::class, 'updatePassword'])->name('update-password');
// Cập nhật ảnh đại diện
Route::post('/update-avatar', [InformationController::class, 'updateAvatar'])->name('update-avatar');

Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');

Route::post('/check-coupon', [CheckoutController::class, 'checkCoupon']);

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

// trang thanh toán
Route::get('/bank/{id}', [CheckoutController::class, 'bankPage'])->name('bank.page');
Route::post('/bank-success', [CheckoutController::class, 'paymentSuccess']);

Route::get('/momo/{id}', [CheckoutController::class, 'momoPage'])->name('momo.page');
Route::post('/momo-success', [CheckoutController::class, 'paymentSuccess']);

//
Route::get('/tour_booked', [TourBookedController::class, 'index'])
    ->name('tour_booked');

Route::post('/review', [ChiTietToursController::class, 'store'])
    ->name('review');

//huy tour
Route::get('/booking/cancel/{id}', [TourBookedController::class, 'cancelBooking'])->name('booking.cancel');

//ADMIN
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/profile', [AdminManagementController::class, 'index'])->name('admin.profile');

    Route::post('/update-admin', [AdminManagementController::class, 'updateAdmin'])->name('admin.update-admin');
    Route::post('/update-avatar', [AdminManagementController::class, 'updateAvatar'])->name('admin.update-avatar');

//TOURS

    Route::get('/tours', [ToursManagementController::class, 'index'])
        ->name('admin.tours');

    Route::get('/tours/add', [ToursManagementController::class, 'create'])
        ->name('admin.tours.create');

    Route::post('/tours/add', [ToursManagementController::class, 'addTours'])
        ->name('admin.tours.add');

    Route::post('/tours/upload-images', [ToursManagementController::class, 'addImagesTours'])
        ->name('admin.tours.upload-images');

    Route::post('/tours/timeline', [ToursManagementController::class, 'addTimeline'])
        ->name('admin.tours.timeline');

    Route::get('/tours/{id}', [ToursManagementController::class, 'getTourDetail'])
        ->name('admin.tours.detail');

    Route::get('/tours/edit/{id}', [ToursManagementController::class, 'edit'])
    ->name('admin.tours.edit');

    Route::post('/tours/update/{id}', [ToursManagementController::class, 'updateTour'])
        ->name('admin.tours.update');

    Route::post('/tours/delete/{id}', [ToursManagementController::class, 'deleteTour'])
        ->name('admin.tours.delete');
});
 ///booking
 Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/booking', [BookingManagementController::class, 'index'])
        ->name('booking');
    Route::post('/booking/confirm', [BookingManagementController::class, 'confirmBooking']);
    Route::post('/booking/cancel', [BookingManagementController::class, 'cancelBooking'])
    ->name('booking.cancel');
    Route::post('/booking/delete/{id}', [BookingManagementController::class, 'deleteBooking']);
    
    Route::get('/booking/detail/{id}', [BookingManagementController::class, 'showDetail'])
    ->name('booking.detail');
    Route::get('/users', [UserManagementController::class, 'index'])->name('users');

    Route::post('/user/active', [UserManagementController::class, 'activeUser'])->name('active-user');

    Route::post('/user/status', [UserManagementController::class, 'changeStatus'])->name('status-user');

});