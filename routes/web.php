<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Brandcontroller;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Productcontroller;
use App\Http\Controllers\Admin\Statecontroller;
use App\Http\Controllers\Admin\Bannercontroller;
use App\Http\Controllers\Admin\Aboutuscontroller;
use App\Http\Controllers\Admin\Businesspackage;
use App\Http\Controllers\Admin\Teamcontroller;
use App\Http\Controllers\Admin\Testimonials;
use App\Http\Controllers\Admin\Categories;
use App\Http\Controllers\Admin\Blogcontroller;
use App\Http\Controllers\Admin\Helpcontroller;
use App\Http\Controllers\Admin\Faqcontroller;
use App\Http\Controllers\Admin\Areacontroller;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Front\Categorycontroller;
use App\Http\Controllers\Front\Commoncontroller;
use App\Http\Controllers\Front\Packagecontrolller;
use App\Http\Controllers\Front\Bookingcontroller;
use App\Http\Controllers\Front\Ordercontroller;
use App\Http\Controllers\Front\Usercontroller;
use App\Http\Controllers\Auditorcontroller;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Checkauth;
use App\Http\Middleware\Usernotallowed;
use App\Http\Middleware\Auditor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */


 Route::middleware([Checkauth::class])->group(function () {
        Route::match(['get','post'],'/bulk-enquiry', [Usercontroller::class, 'bulk_enquiry'])->name('bulk_enquiry');
        Route::match(['get','post'],'/my-enquires', [Usercontroller::class, 'my_enquires'])->name('my_enquires');
        Route::match(['get','post'],'/my-wallet', [Usercontroller::class, 'mywallet'])->name('mywallet');
 });
//  --book-controllers

Route::post('/book-items/{product_id}', [Bookingcontroller::class, 'book_items'])->middleware(Checkauth::class)->name('book_items');
Route::match(['get','post'],'/book-cycle', [Bookingcontroller::class, 'bookcycle'])->middleware(Checkauth::class)->name('bookcycle');
Route::match(['get','post'],'/pay-items-amount', [Bookingcontroller::class, 'payitemsamount'])->middleware(Checkauth::class)->name('payitemsamount');
Route::match(['get','post'],'/my-bookings', [Bookingcontroller::class, 'mybookings'])->middleware(Checkauth::class)->name('mybookings');
Route::post('/updatecheckoutdetails', [Bookingcontroller::class, 'updatecheckoutdetails'])->middleware(Checkauth::class)->name('updatecheckoutdetails');
Route::post('/bookingview', [Bookingcontroller::class, 'bookingview'])->middleware(Checkauth::class)->name('bookingview');
Route::get('/cancelbookingid/{bookingid}', [Bookingcontroller::class, 'cancelbookingid'])->middleware(Checkauth::class)->name('cancelbookingid');
Route::get('/cancel-booking/{bookingid}', [Bookingcontroller::class, 'cancelbooking'])->middleware(Checkauth::class)->name('cancelbooking');

Route::post('/accept-booking', [Bookingcontroller::class, 'acceptbooking'])->middleware(Checkauth::class)->name('acceptbooking');
Route::get('/accept-checkout/{bookid}', [Bookingcontroller::class, 'acceptcheckout'])->middleware(Usernotallowed::class)->name('acceptcheckout');
Route::get('/cancel-checkout/{bookid}', [Bookingcontroller::class, 'cancelcheckout'])->middleware(Usernotallowed::class)->name('cancelcheckout');


// Route::post('/verify-payment', [Bookingcontroller::class, 'verifypayment'])->middleware(Checkauth::class)->name('verifypayment');
Route::post('/verify-payment', [Bookingcontroller::class, 'verifypayment'])->name('verifypayment');



Route::post('/calculate-checkout-payment', [Bookingcontroller::class, 'calculateCheckoutPayment'])->middleware(Checkauth::class)->name('calculateCheckoutPayment');
Route::get('/checkout-payment', [Bookingcontroller::class, 'checkoutPayment'])->middleware(Checkauth::class)->name('checkoutPayment');
Route::post('/verify-checkout-payment', [Bookingcontroller::class, 'verifyCheckoutPayment'])->middleware(Checkauth::class)->name('verifyCheckoutPayment');
Route::get('/continue-to-checkout-without-gt', [Bookingcontroller::class, 'continuetocheckoutwithoutGt'])->middleware(Checkauth::class)->name('continuetocheckoutwithoutGt');

// Add this with your other booking routes
Route::post('/provider-process-checkout', [Ordercontroller::class, 'providerProcessCheckout'])->middleware(Usernotallowed::class)->name('providerProcessCheckout');

// ordercontrollers

Route::get('/my-orders', [Ordercontroller::class, 'myorders'])->middleware(Usernotallowed::class)->name('myorders');
Route::post('/submit-rating-to-customer', [Ordercontroller::class, 'submitrating_to_customer'])->middleware(Usernotallowed::class)->name('submitrating_to_customer');
Route::post('/vieworderdetails', [Ordercontroller::class, 'vieworderdetails'])->middleware(Usernotallowed::class)->name('vieworderdetails');


//  --book-controllers end



Route::get('/', [Commoncontroller::class, 'index'])->name('home');

Route::get('/send-verify-email/{email}', [Commoncontroller::class, 'sendverifyemail'])->middleware(Checkauth::class)->name('sendverifyemail');
Route::get('/verify-email/{token}', [Commoncontroller::class, 'verifyemail'])->name('verifyemail');


Route::get('/my-setting', [Commoncontroller::class, 'settings'])->middleware(Checkauth::class);
Route::post('/update-profile', [Commoncontroller::class, 'updateprofile'])->middleware(Checkauth::class);
Route::post('/submit-rating', [Commoncontroller::class, 'submitrating'])->middleware(Checkauth::class);
Route::post('/getallreviews', [Commoncontroller::class, 'getallreviews'])->middleware(Checkauth::class);
Route::post('/savecards', [Commoncontroller::class, 'savecards'])->middleware(Checkauth::class);
Route::get('/search-available-products', [Commoncontroller::class, 'searchAvailableProducts'])->name('searchAvailableProducts');
Route::get('/my-ads', [Commoncontroller::class, 'myads'])->name('myads');
Route::get('/blogs', [Commoncontroller::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [Commoncontroller::class, 'blogview'])->name('blogview');
Route::get('/packages', [Commoncontroller::class, 'packages'])->name('packages');
Route::get('/help', [Commoncontroller::class, 'help'])->name('help');
Route::get('/help/{slug}', [Commoncontroller::class, 'helpdetails'])->name('helpdetails');
Route::get('/about', [Commoncontroller::class, 'about'])->name('about');
Route::get('/terms-condition', [Commoncontroller::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [Commoncontroller::class, 'privacypolicy'])->name('privacypolicy');
Route::get('/faq', [Commoncontroller::class, 'faq'])->name('faq');
Route::match(['get', 'post'], '/contact', [Commoncontroller::class, 'contact'])->name('contact');
Route::get('/category', [Commoncontroller::class, 'category'])->name('category');
Route::get('/product/{slug}', [Commoncontroller::class, 'productdetail'])->name('productdetail');
Route::post('/check_offer', [Commoncontroller::class, 'check_offer'])->name('check.offer');
Route::post('/registeruser', [Commoncontroller::class, 'registeruser'])->name('registeruser');
Route::post('/loginuser', [Commoncontroller::class, 'loginuser'])->name('loginuser');
Route::get('/userlogout', [Commoncontroller::class, 'logoutfront'])->name('userlogout');
Route::get('/new-post', [Commoncontroller::class, 'new_post'])->name('new_post');
Route::match(['get', 'post'], '/product-edit/{slug}', [Commoncontroller::class, 'product_edit_front'])->name('product_edit_front');
Route::post('/addtowishlist', [Commoncontroller::class, 'addtowishlist'])->name('addtowishlist');
Route::post('/create-post', [Commoncontroller::class, 'create_post'])->name('create_post');
Route::post('/addtocart', [Commoncontroller::class, 'addtocart'])->name('addtocart');
Route::post('/updatecartquantity', [Commoncontroller::class, 'updatecartquantity'])->name('updatecartquantity');
Route::post('/getdisrtict', [Commoncontroller::class, 'getdisrtict'])->name('getdisrtict');
Route::get('/my-products', [Commoncontroller::class, 'myproducts'])->middleware(Checkauth::class)->name('myproducts');
Route::get('/wishlist', [Commoncontroller::class, 'wishlist'])->middleware(Checkauth::class)->name('wishlist');
Route::get('/cart', [Commoncontroller::class, 'cart_items'])->middleware(Checkauth::class)->name('cart_items');
Route::get('/deletecartitem/{id}', [Commoncontroller::class, 'deletecartitem'])->middleware(Checkauth::class)->name('deletecartitem');
Route::get('/remove/wishlist/{id}', [Commoncontroller::class, 'remove_wishlist'])->middleware(Checkauth::class)->name('remove_wishlist');
Route::get('/flushsession', [Commoncontroller::class, 'flushsession'])->middleware(Checkauth::class)->name('flushsession');
Route::match(['get', 'post'], '/register/sr-vendor/vendor', [Commoncontroller::class, 'registervendor'])->name('registervendor');
Route::match(['get', 'post'], '/register/auditor', [Commoncontroller::class, 'auditor_register'])->name('auditor_register');
Route::post('/update-repair-status', [Commoncontroller::class, 'updateRepairStatus'])
    ->middleware(Usernotallowed::class)
    ->name('update.repair.status');
Route::post('/update-auditor-change', [Commoncontroller::class, 'changeauditor'])
    ->middleware(Usernotallowed::class)
    ->name('update.auditor-repair');

// --packages -
Route::get('/packages', [Packagecontrolller::class, 'packages'])->middleware(Usernotallowed::class)->name('packages');
Route::post('/buypackage', [Packagecontrolller::class, 'buypackage'])->middleware(Usernotallowed::class)->name('buypackage');

 Route::post('/renew/{id}', [Packagecontrolller::class,'renew'])->name('package.renew');
    Route::post('/upgrade/{id}', [Packagecontrolller::class,'upgrade'])->name('package.upgrade');


// Route::get('/user-packages', [Commoncontroller::class, 'user_packages'])->name('user_packages');
// Route::get('/profile', [Commoncontroller::class, 'profile'])->name('profile');

// user-products-pages

Route::match(['get', 'post'], '/rental-products', [Categorycontroller::class, 'products'])->name('products');
Route::post('/search-cycles', [Categorycontroller::class, 'searchcycles'])->name('searchcycles');
// Route::post('/searchproducts', [Categorycontroller::class, 'searchproducts'])->name('searchproducts');

Route::middleware([Admin::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    Route::post('/updateprofileadmin', [PageController::class, 'updateprofileadmin'])->name('updateprofileadmin');
    Route::post('/updatepassword', [PageController::class, 'updatepassword'])->name('updatepassword');
    // AdminController
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::match(['get', 'post'], '/add-category', [AdminController::class, 'addcategory'])->name('addcategory');
    Route::match(['get', 'post'], '/categories-edit/{id}', [AdminController::class, 'editcategory'])->name('editcategory');
    Route::match(['get', 'post'], '/view-subcategories/{id}', [AdminController::class, 'viewsubcategories'])->name('viewsubcategories');
    Route::match(['get', 'post'], '/change-status/{table}/{id}', [Admincontroller::class, 'changestatus'])->name('change.status');
    Route::match(['get', 'post'], '/block-unblock/{table}/{id}', [Admincontroller::class, 'changeblock'])->name('change.block');
    Route::match(['get', 'post'], '/delete/{table}/{id}/{image}', [Admincontroller::class, 'deleterow'])->name('deleterow');
    Route::match(['get', 'post'], '/enquries', [Admincontroller::class, 'enquries'])->name('enquries');
    Route::match(['get', 'post'], '/bulk-enquries', [Admincontroller::class, 'bulkenquries'])->name('bulkenquries');
    Route::post('/getenquiry', [Admincontroller::class, 'getenquiry'])->name('getenquiry');
    Route::match(['get', 'post'], '/web-setting', [Admincontroller::class, 'websetting'])->name('websetting');

    // users-management /

    Route::get('/view-users', [AdminController::class, 'viewusers'])->name('viewusers');
    Route::get('/changeactivestatus/vendor/{id}', [AdminController::class, 'changeactivestatus'])->name('changeactivestatus');
    Route::get('/view-providers', [AdminController::class, 'viewproviders'])->name('viewproviders');
    Route::get('/view-vendors', [AdminController::class, 'viewvendors'])->name('viewvendors');
    Route::get('/auditors', [AdminController::class, 'auditors'])->name('auditors');
    Route::get('/view-vendor-providers/{id}', [AdminController::class, 'user_full_view'])->name('user_full_view');

    Route::get('/form', [PageController::class, 'adminform'])->name('adminform');
    Route::get('/tables', [PageController::class, 'tables'])->name('tables');

    Route::get('/view-districts/{id}', [AdminController::class, 'viewdistricts'])->name('viewdistricts');
    Route::match(['get', 'post'], '/districts/create/{id}', [AdminController::class, 'districtscreate'])->name('districtscreate');
    Route::match(['get', 'post'], '/district-edit/{id}', [AdminController::class, 'districtedit'])->name('district.edit');

    // --products
    Route::get('/products', [Productcontroller::class, 'products'])->name('products');
    Route::get('/delete/products/{id}', [Productcontroller::class, 'delete_products'])->name('delete_products');
    Route::get('/product-view/{id}', [Productcontroller::class, 'productview'])->name('productview');
    Route::get('/product-change-verify-status/{status}/{id}', [Productcontroller::class, 'product_verify'])->name('product_verify');
    Route::get('/packages', [Businesspackage::class, 'packages'])->name('packages');
    Route::match(['get','post'],'/new-package', [Businesspackage::class, 'newpackage'])->name('newpackage');
    Route::match(['get','post'],'/packages/edit/{id}', [Businesspackage::class, 'packageupdate'])->name('packageupdate');
    // orders
    Route::match(['get','post'],'/orders', [AdminController::class, 'orders'])->name('orders');
    Route::match(['get','post'],'/order-view/{id}', [AdminController::class, 'orderview'])->name('orderview');
    
    Route::get('/orders/data', [AdminController::class, 'ordersdata'])->name('admin.orders.data');

    
    Route::get('/advanced-setting', [AdminController::class, 'advancedsetting'])->name('advancedsetting');
    Route::post('/update-servicetime', [AdminController::class, 'updateservicetime'])->name('updateservicetime');
    Route::post('/update-offersetting', [AdminController::class, 'update_offer'])->name('update_offer');


    Route::get('/products-elements', [AdminController::class, 'products_elements'])->name('products_elements');
    Route::get('/product-element-list', [AdminController::class, 'product_element_list'])->name('product_element_list');
    Route::match(['get','post'],'/product-elements/create', [AdminController::class, 'product_element_create'])->name('product_element_create');
    Route::match(['get','post'],'/product-elements/edit/{id}', [AdminController::class, 'product_element_edit'])->name('productselement.edit');

    // Inside the admin middleware group
Route::get('/export-orders/{format}', [AdminController::class, 'exportOrders'])->name('export.orders');

    // --resources-controllers-examples
    Route::resource('brands', Brandcontroller::class);
    Route::resource('states', Statecontroller::class);
    Route::resource('areas', Areacontroller::class);
    Route::resource('banners', Bannercontroller::class);
    Route::resource('testimonials', Testimonials::class);
    Route::resource('help', Helpcontroller::class);
    Route::resource('faq', Faqcontroller::class);
    Route::resource('aboutus', Aboutuscontroller::class);
    Route::resource('teams', Teamcontroller::class);
    Route::resource('blogs', Blogcontroller::class);
});

// Route::get('/sign-up', [Authcontroller::class, 'signup'])->name('signup');
Route::get('/admin/login', [Authcontroller::class, 'adminsignin'])->name('adminsignin');
Route::match(['get', 'post'], '/forgot-password', [Authcontroller::class, 'forgotPassword'])->name('forgotPassword');
Route::match(['get', 'post'], '/reset-password', [Authcontroller::class, 'resetpassword'])->name('resetpassword');
Route::match(['get', 'post'], 'reset-password/{token}', [AuthController::class, 'tokanchangepassword'])->name('tokanchangepassword');
Route::post('/login', [Authcontroller::class, 'login_via_email_password'])->name('login_via_email_password');
Route::get('/log-out', [Authcontroller::class, 'logout'])->name('logout');


// Add these routes to the web.php file
Route::get('/request-repair/{id}', [Commoncontroller::class, 'requestRepair'])->middleware(Checkauth::class)->name('requestRepair');
Route::get('/auditor/repair-cycles', [Auditorcontroller::class, 'repairCycles'])->middleware(Auditor::class)->name('repairCycles');
Route::get('/auditor/mark-repaired/{id}', [Auditorcontroller::class, 'markRepaired'])->middleware(Auditor::class)->name('markRepaired');



Route::middleware([Auditor::class])->prefix('auditor')->group(function () {
    Route::post('/updateprofile', [Auditorcontroller::class, 'updateprofile'])->name('updateprofile');
    Route::post('/updatepassword', [PageController::class, 'updatepassword'])->name('updatepassword');
    Route::get('/dashboard', [Auditorcontroller::class, 'dashboard'])->name('auditordashboard');
    Route::get('/cycles', [Auditorcontroller::class, 'cycles'])->name('cycles');
    Route::get('/logout', [Auditorcontroller::class, 'logout'])->name('logout');
    Route::get('/cycle-view/{id}', [Auditorcontroller::class, 'view_cycle'])->name('view_cycle');
    Route::match(['get','post'],'/my-profile', [Auditorcontroller::class, 'myprofile'])->name('myprofile');
});