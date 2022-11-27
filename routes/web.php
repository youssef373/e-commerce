<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaginationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/paginate/fetch_data', [PaginationController::class, 'fetch_data']);

Route::controller(HomeController::class)->group(function(){
    Route::get('/home', 'redirect') ->middleware('auth', 'verified');;
    Route::get('/',  'index');
    Route::get('/products','showProducts');
    Route::get('/product_details/{id}','showProductDetails');
    Route::get('search_product', 'searchProduct');
    Route::post('/add_to_cart/{id}','addCartProduct');
    Route::get('/cart_items_view','showCartItemsView');
    Route::get('/update_cart_product_view/{id}','updateCartProductView');
    Route::post('/update_cart_product_quantity/{cart_id}','updateCartProductQuantity');
    Route::get('/remove_cart_product/{id}','removeCartProduct');
    Route::get('/remove_cart_products','removeAllCartProducts');
    Route::get('/cash_order', 'cashOrder');
    Route::get('/user_orders', 'showUserOrders');
    Route::get('/cancel_order/{id}', 'cancelOrder');
    Route::post('/add_comment', 'addComment');
    Route::post('/delete_comment/{id}', 'deleteComment');
    Route::get('/show_comments', 'showComments');
    Route::post('/add_comment_reply', 'addCommentReply');
});

Route::controller(AdminController::class)->group(function() {
    Route::get('/add_category_view','add_category_view');
    Route::match(['get','post'],('/add_category'),'add_category');
    Route::get('/show_categories_view','show_all_categories');
    Route::get('/delete_category/{id}', 'deleteCategory');
    Route::get('/add_product_view','addProductView');
    Route::match(['get','post'],('/add_product'),'addProduct');
    Route::get('/show_products','showProducts');
    Route::get('/delete_product/{id}','deleteProduct');
    Route::get('/update_product_view/{id}','updateProductView');
    Route::match(['get','post'],('/update_product/{id}'), 'updateProduct');
    Route::get('/show_orders', 'showOrders');
    Route::get('/deliver_order/{id}', 'deliverOrder');
    Route::get('/print_pdf/{id}', 'printPdf');
    Route::get('/send_email_view/{id}', 'sendEmailView');
    Route::match(['get','post'],('/send_email/{id}'), 'sendEmail');
    Route::get('/search_orders', 'searchOrders');
});

Route::controller(\App\Http\Controllers\StripePaymentController::class)->group(function(){
    Route::get('/stripe/{total_price}', 'stripPayment');
    Route::post('stripe/{total_price}', 'stripePost')->name('stripe.post');
});

















