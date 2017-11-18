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
*/

/**
 * Authentication
 */
Route::post('/sign-up','Auth\RegisterController@newUser');
Route::post('/sign-in','Auth\LoginController@doLogin');

Route::group(['prefix' => 'v1','middleware'=>'apiauth'],function(){


    //Route::get('/acknowledge','Home\HomeController@acknowledge');
    //Route::get('/acknowledge2','Home\HomeController@acknowledge2');

    Route::post('/saveItem','Item\ItemsController@saveItem');
    Route::post('/saveSupplier','Supplier\SuppliersController@saveSupplier');
    Route::post('/saveCustomer','Customer\CustomersController@saveCustomer');
});

/*
Route::group(['prefix' => 'v1'],function(){
    Route::post('/saveItem','Item\ItemsController@saveItem');
    Route::post('/saveCategory','Category\CategoriesController@saveCategory');
    //Route::post('/saveCategory','Category\CategoriesController@saveCategory');
});

*/