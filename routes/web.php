<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::post('email-gift', 'EmailGiftController@index')->name('email-gift');
Route::post('email-voucher', 'EmailVoucherController@index')->name('email-voucher');

/**
 * Shopping
 */
Route::group(['namespace' => 'Shopping'], function () {
    Route::get('resources/views/pages/shopping/c{id}/{alias}.html', 'CategoryController@index')->name('shopping.index');
    Route::get('resources/views/pages/shopping/p{id}/{alias}.html', 'ProductController@index')->name('product.index');
    Route::get('resources/views/pages/shopping/p{id}', 'ProductController@ajaxcomment')->name('ajaxcomment.index');
    Route::get('/thanks-comment', 'ProductController@thanksComment')->name('thanks-cmt');
    Route::get('/answer-comment', 'ProductController@answerComment')->name('answer_cmt');

    Route::get('resources/views/pages/shopping/c1/sach-ban-chay.html', 'CategoryController@index')->name('shopping-best-sale.index');
    Route::get('resources/views/pages/shopping/c2/sach-moi-phat-hanh.html', 'CategoryController@index')->name('shopping-new-released.index');
    Route::get('resources/views/pages/shopping/c4/sach-combo.html', 'CategoryController@index')->name('shopping-top-combo.index');
    Route::get('resources/views/pages/shopping/c3/sach-giam-gia.html', 'CategoryController@index')->name('shopping-discount.index');
    Route::get('resources/views/pages/shopping/c5/sach-sap-phat-hanh.html', 'CategoryController@index')->name('shopping-coming-soon.index');
    Route::get('/wish{id}', 'ProductController@wish')->name('wish-list');

    Route::get('/del-wish/{id}', 'ProductController@del_wish')->name('del-wish');
    // Route::get('resources/views/pages/shopping/c{id}/{alias}.html', 'publisherController@index')->name('publisher.index');
});
Route::get('/publisher/{alias}.html', 'PublisherController@index')->where('alias', '.*')->name('publisher.index');

Route::get('/resultPayment', 'CheckoutController@resultPayment')->name('resultPayment');
Route::get('/ipnPayment', 'CheckoutController@ipnPayment')->name('ipnPayment');

Route::group(['prefix' => 'checkout'], function () {
    Route::get('/shipping', 'CheckoutController@shipping')->name('shipping');
    Route::get('/shipping-notLogin', 'CheckoutController@shippingNotLogin')->name('shipping-notlogin');
    Route::post('/process', 'CheckoutController@beforProcess')->name('checkout-process');
    Route::post('/processing', 'CheckoutController@afterProcess')->name('checkout-processing');
    Route::get('/done/{id}', 'CheckoutController@done')->name('checkout-done');
    Route::get('/done-gift/{id}', 'CheckoutController@done_gift')->name('checkout-done-gift');
    Route::get('/mail', 'CheckoutController@mailOrder')->name('checkout-email');
    Route::get('/coupon', 'CheckoutController@coupon')->name('checkout-coupon');
    //Vinhomes
    Route::get('/vinhomes', 'CheckoutController@vinhomes')->name('vinhomes');

});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', 'CustomerController@index')->name('customer');
    Route::get('/orders', 'CustomerController@order')->name('customer-order');
    Route::get('/detail-order/{id}', 'CustomerController@detailOrder')->name('detail-order');
    Route::get('/comments', 'CustomerController@comment')->name('customer-comment');
    Route::get('/addresses', 'CustomerController@manageAddress')->name('customer-addresses');
    Route::get('/setting', 'CustomerController@setting')->name('customer-setting');
    Route::get('/question', 'CustomerController@question')->name('customer-question');
    Route::get('/favorite', 'CustomerController@favorite')->name('customer-favorite');
    Route::get('/updatepassword', 'CustomerController@updatepassword')->name('customer-updatepassword');
    Route::put('/updatepassword/{id}', 'CustomerController@putUpdatePassword')->name('customer-putUpdatePassword');

    Route::get('/myinformation', 'CustomerController@myinformation')->name('customer-myinformation');

    Route::get('/product-view', 'CustomerController@productview')->name('product-view');
    Route::get('/create-address', 'CustomerController@beforCreateAddress')->name('create-address');
    Route::post('/store-address', 'CustomerController@createAddress')->name('store-address');
    Route::get('/delete-address/{id}', 'CustomerController@deleteAddress')->name('delete-address');

    //Thứ 7: 3/1/19
    Route::post('/update-customer', 'CustomerController@postUpdateCustomer')->name('customer-update');

    Route::post('/update-phone-customer', 'CustomerController@postUpdatePhone')->name('customer-update-phone');

    Route::get('/edit-address/{id}', 'CustomerController@getEditAddress')->name('edit-address');
    Route::post('/edit-address/{id}', 'CustomerController@postEditAddress')->name('post-edit-address');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@index')->name('cart');
    Route::get('/add', 'CartController@addCart')->name('cart-add');
    Route::delete('/remove-product/{id}', 'CartController@remove')->name('cart-remove');
    Route::delete('/delete-product', 'CartController@deleteCart')->name('cart-delete');
    Route::get('/update-product', 'CartController@updateAjax')->name('cart-update');
    // Route::get('/total-cart', 'CartController@getTotalAjax')->name('total-cart');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/quantity/{id}', 'Shopping\ProductController@getQuantity')->name('product-quantity');
    Route::post('/comment', 'Shopping\ProductController@comment')->name('product-comment');
    Route::post('/question', 'Shopping\ProductController@question')->name('product-question');
    Route::get('/reply-question/{id}', 'Shopping\ProductController@reply')->name('reply-question');
    Route::get('/like-question', 'Shopping\ProductController@likeQuestion')->name('like-question');
    Route::get('/like-answer', 'Shopping\ProductController@likeAnswer')->name('like-answer');
    Route::post('/answer/', 'Shopping\ProductController@answer')->name('answer');
});


Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/search', 'HomeController@search')->name('search');

// Login by Fb, GG
Route::get('facebook/redirect', 'FacebookController@redirect')->name('facebook-login');
Route::get('facebook/callback', 'FacebookController@callback');

Route::get('google/redirect', 'GoogleController@redirect')->name('google-login');
Route::get('google/callback', 'GoogleController@callback');

//About Rbooks
Route::get('/about-rbooks', 'HomeController@aboutRbooks')->name('about-rbooks');

//Recruitment
Route::get('/recruitment', 'HomeController@recruitment')->name('recruitment');

Route::post('/apply', 'HomeController@postApply')->name('apply');
Route::get('/recruitment/{id}.html', 'HomeController@recruitmentDetail')->name('recruitment-detail');


// Method shipping
Route::get('/shipping-method', 'HomeController@shipping')->name('shipping-method');


// Method payment
Route::get('/payment', 'HomeController@payment')->name('payment');


//Privacy Policy
Route::get('/privacy', 'HomeController@privacy')->name('privacy');


//Privacy Policy
Route::get('/how-to-order', 'HomeController@order')->name('how-to-order');

// Reply Question

Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('products', 'HomeController@products')->name('products');
Route::get('paper', 'HomeController@paper')->name('paper');

//Change Language
// Route::group(['middleware' => 'locale'], function() {
//     Route::post('/lang', [
//           'as' => 'switchLang',
//           'uses' => 'LangController@changeLang',
//       ]);
// });
Route::get('locale/{locale}', function ($locale) {
    // lưu ngôn ngữ vào session
    session(['locale' => $locale]);
    return redirect(url()->previous());
    //
});
