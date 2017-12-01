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
*
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', "User\UsersController@index");
Route::get('/sign-up.html', "Auth\RegisterController@signUp");
Route::post('/sign-up.html', "Auth\RegisterController@newUser");
Route::get('/sign-in.html', 'User\UsersController@index');
Route::post('/sign-in.html', "Auth\LoginController@doLogin");

//User related Routes
Route::group(['prefix' => 'secure'], function () {
    Route::get('/dashboard.html', 'Home\HomeController@index');

    Route::get('/items', 'Item\ItemsController@index');
    Route::get('/add-items', 'Item\ItemsController@addItem');
    Route::get('/add-items/{id}', 'Item\ItemsController@addItem');
    Route::post('/add-items/{id}', 'Item\ItemsController@saveItem');
    Route::post('/add-items', 'Item\ItemsController@saveItem');
    Route::post('/saveItem', 'Item\ItemsController@saveItem');

    Route::get('/view-item/{id}', 'Item\ItemsController@viewItem');

    Route::get('/categories', 'Category\CategoriesController@index');
    Route::get('/add-categories', 'Category\CategoriesController@addCategory');
    Route::get('/add-categories/{id}', 'Category\CategoriesController@addCategory');
    Route::post('/add-categories/{id}', 'Category\CategoriesController@saveCategory');
    Route::post('/add-categories', 'Category\CategoriesController@saveCategory');
//    Route::post('/saveCategory','Category\CategoriesController@saveCategory');

    Route::get('/add-users', 'Auth\RegisterController@addUser');

    Route::get('/suppliers', 'Supplier\SuppliersController@index');
    Route::get('/add-suppliers', 'Supplier\SuppliersController@addSupplier');
    Route::get('/add-suppliers/{id}', 'Supplier\SuppliersController@addSupplier');
    Route::post('/add-suppliers/{id}', 'Supplier\SuppliersController@saveSupplier');
    Route::post('/add-suppliers', 'Supplier\SuppliersController@saveSupplier');

    Route::get('/customers', 'Customer\CustomersController@index');
    Route::get('/add-customers', 'Customer\CustomersController@addCustomer');
    Route::get('/add-customers/{id}', 'Customer\CustomersController@addCustomer');
    Route::post('/add-customers/{id}', 'Customer\CustomersController@saveCustomer');
    Route::post('/add-customers', 'Customer\CustomersController@saveCustomer');

    Route::get('/purchase', 'Purchase\PurchaseController@index');
    Route::post('/purchase', 'PurchaseReturn\PurchaseReturnController@savePurchaseReturns');
    Route::get('/add-purchase', 'Purchase\PurchaseController@addPurchase');
    Route::post('/add-purchase', 'Purchase\PurchaseController@savePurchase');

    Route::get('/sales', 'Sales\SalesController@index');
    Route::post('/sales', 'SalesReturn\SalesReturnController@saveSalesReturns');
    Route::get('/add-sales', 'Sales\SalesController@addSales');
    Route::post('/add-sales', 'Sales\SalesController@saveSales');
    Route::get('/add-sales/{id}', 'Sales\SalesController@saveSales');


    Route::get('/stocks', 'Ledger\LedgerController@getTotalStockBalance');
    Route::get('/stocks/{id}', 'Ledger\LedgerController@getIndividualItemEntries');

    Route::get('/item/{id}', 'Ledger\LedgerController@getIndividualDebitEntries');

    Route::get('/transactions', 'Transaction\TransactionController@getTransactions');
    Route::get('/transactions/{id}', 'Transaction\TransactionController@getTransactions');


    Route::get('/purchaseReturns/{id}', 'PurchaseReturn\PurchaseReturnController@getPurchaseReturns');
    Route::get('/purchaseReturns', 'PurchaseReturn\PurchaseReturnController@getPurchaseReturns');
    Route::post('/purchaseReturns', 'PurchaseReturn\PurchaseReturnController@savePurchaseReturns');

    Route::get('/salesReturns/{id}', 'SalesReturn\SalesReturnController@getSalesReturns');
    Route::get('/salesReturns', 'SalesReturn\SalesReturnController@getSalesReturns');
    Route::post('/salesReturns', 'SalesReturn\SalesReturnController@saveSalesReturns');


    Route::get('/reports', 'Reports\ReportsController@index');
    Route::post('/reports', 'Reports\ReportsController@saveReports');


});

//User related Routes
Route::group(['prefix' => 'user'], function () {
    Route::get('/add.html', 'User\UsersController@index');
    Route::get('/view.html/{id}', 'User\UsersController@view');
});

//Item related Routes
Route::group(['prefix' => 'item'], function () {
    Route::get('/add.html', 'Item\ItemsController@index');
    //Route::get('/view.html/{id}','Item\ItemsController@view');
});