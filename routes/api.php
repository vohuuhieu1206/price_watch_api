<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|




/*
*	Product
*/

Route::resource('products', 'Product\ProductController',['only' => ['index','show']]);

Route::resource('products.prices', 'Product\ProductPricesController',['only' => ['index']]);
Route::name('realprice')->get('products/{product}/realprice','Product\ProductPricesController@realprice');

Route::resource('products.reviews', 'Product\ProductReviewsController',['only' => ['index']]);
Route::resource('products.provider', 'Product\ProductProviderController',['only' => ['index']]);
Route::resource('products.specification', 'Product\ProductSpecificationController',['only' => ['index']]);

/*
*	Follow
*/
Route::resource('follows', 'Follow\FollowController',['only' => ['index','store','destroy']]);
/*
*	User
*/
// Route::name('me')->get('users/me','User\UserController@me');

Route::resource('users', 'User\UserController',['except' => ['create','edit']]);
Route::resource('users.products', 'User\UserFollowProductController',['only' => ['index']]);
Route::name('verify')->get('users/verify/{token}','User\UserController@verified');
Route::name('resend')->get('users/{user}/resend','User\UserController@resendMail');
