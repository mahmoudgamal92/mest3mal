<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth apis
Route::post('/user/login', function (Request $request) {
    /// validation 
    $credentials = request(['email', 'password']);
    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return response()->json([
        'token' => $token, // Token
        'expires' => auth('api')->factory()->getTTL() * 60, // Expiration
    ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Show all States
Route::get('states', function () {
    $countries = \App\Orbscope\Models\Country::all();
    return $countries;
});
// Show all cities
Route::get('cities', function () {
    $city = \App\Orbscope\Models\City::all();
    return $city;
});
//all _departments
Route::get('departments', function () {
    $shops = \App\Orbscope\Models\Department::all();
    return $shops;
});
// Show all categories
Route::get('categories', function () {
    $shops = \App\Orbscope\Models\Category::all();
    return $shops;
});
//all_sub_category
Route::get('sub_categories', function () {
    $shops = \App\Orbscope\Models\SubCategory::all();
    return $shops;
});
// Show ads of selected State_id
Route::get('/state/{id}/ads', function ($id) {
    $ads = \App\Orbscope\Models\Ad::where('state_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});
// Show ads of selected city_id
Route::get('/city/{id}/ads', function ($id) {
    $ads = \App\Orbscope\Models\Ad::where('city_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});
// Show ads of selected depart_id
Route::get('/depart/{id}/ads', function ($id) {
    $ads = \App\Orbscope\Models\Ad::where('depart_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});
// Show ads of selected cat_id
Route::get('/category/{id}/ads', function ($id) {
    $ads = \App\Orbscope\Models\Ad::where('cat_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});
// Show ads of selected sub_cat
Route::get('/sub_category/{id}/ads', function ($id) {
    $ads = \App\Orbscope\Models\Ad::where('subcat_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});

// show ads of selected state & selected city
Route::get('/state/{id_state}/city/{id_city}/ads', function ($id_state, $id_city) {
    $products = \App\Orbscope\Models\Ad::where('state_id', $id_state)
        ->where('city_id', $id_city)
        ->orderBy('created_at', 'desc')->get();
    foreach ($products as $product) {

        print_r($product['state']['name']);
    }
    return $products;
});
// show ads of selected state & selected depart
Route::get('/state/{id_state}/department/{id_depart}/ads', function ($id_state, $id_depart) {
    $products = \App\Orbscope\Models\Ad::where('state_id', $id_state)
        ->where('depart_id', $id_depart)
        ->orderBy('created_at', 'desc')->get();
    foreach ($products as $product) {

        print_r($product['state']['name']);
    }
    return $products;
});
// show ads of selected state & selected category
Route::get('/state/{id_state}/category/{id_cat}/ads', function ($id_state, $id_cat) {
    $products = \App\Orbscope\Models\Ad::where('state_id', $id_state)
        ->where('cat_id', $id_cat)
        ->orderBy('created_at', 'desc')->get();
    foreach ($products as $product) {

        print_r($product['state']['name']);
    }
    return $products;
});
// show ads of selected city & selected depart
Route::get('/city/{id_city}/department/{id_depart}/ads', function ($id_city, $id_depart) {
    $products = \App\Orbscope\Models\Ad::where('city_id', $id_city)
        ->where('depart_id', $id_depart)
        ->orderBy('created_at', 'desc')->get();
    foreach ($products as $product) {

        print_r($product['state']['name']);
    }
    return $products;
});
// show ads of selected city & selected category
Route::get('/city/{id_city}/category/{id_cat}/ads', function ($id_city, $id_cat) {
    $products = \App\Orbscope\Models\Ad::where('city_id', $id_city)
        ->where('cat_id', $id_cat)
        ->orderBy('created_at', 'desc')->get();
    foreach ($products as $product) {

        print_r($product['state']['name']);
    }
    return $products;
});
//show all auctions
Route::get('auctions', function () {
    $ads = \App\Orbscope\Models\Auction::where('status', 'active')->orderBy('created_at', 'desc')->get();

    return $ads;
});
// Show auctions of selected state
Route::get('/state/{id}/auctions', function ($id) {
    $ads = \App\Orbscope\Models\Auction::where('state_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});
// Show auctions of selected city
Route::get('/city/{id}/auctions', function ($id) {
    $ads = \App\Orbscope\Models\Auction::where('city_id', $id)->orderBy('created_at', 'desc')->get();

    return $ads;
});
