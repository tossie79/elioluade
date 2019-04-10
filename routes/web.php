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

//Shopping Cart Routes

Route::get('/', 'ProductsController@index')->name('product.index');
Route::get('/add-to-cart/{id}', 'ProductsController@addToCart')->name('product.addToCart');
Route::get('/shopping-cart', 'ProductsController@getCart')->name('product.shoppingCart');
Route::get('/checkout', 'ProductsController@getCheckout')->name('checkout');
Route::post('/checkout', 'ProductsController@checkoutPayment')->name('checkout');
Route::get('/thankyou', 'ProductsController@paymentSuccessFul')->name('thankyou');

 
//Login / Registration Routes
Route::group(['prefix' => 'user'], function() {
    //You can Group By MiddleWare
    /**
      Route::group(['middleware' => 'guest'], function() {
      Route::get('/signup', 'UserController@getSignUpForm')->name('user.signup');
      Route::post('/signup', 'UserController@signUp')->name('user.signup');
      Route::get('/login', 'UserController@getSignInForm')->name('login');
      Route::post('/login', 'UserController@signIn')->name('login');
      });
      Route::group(['middleware' => 'auth'], function() {
      Route::get('/profile', 'UserController@profile')->name('user.profile');
      Route::get('/logout', 'UserController@destroy')->name('user.logout');
      });
     * */
    Route::get('/signup', 'UserController@getSignUpForm')->name('user.signup');
    Route::post('/signup', 'UserController@signUp')->name('user.signup');
    Route::get('/login', 'UserController@getSignInForm')->name('login');
    Route::post('/login', 'UserController@signIn')->name('login');

    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::get('/logout', 'UserController@destroy')->name('user.logout');
});

