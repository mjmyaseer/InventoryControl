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

    Route::get('/items.html', 'Item\ItemsController@index');
    Route::get('/add-items.html', 'Item\ItemsController@addItem');
    Route::post('/add-items.html', 'Item\ItemsController@saveItem');
    Route::post('/saveItem', 'Item\ItemsController@saveItem');

    Route::get('/view-item.html/{id}', 'Item\ItemsController@viewItem');

    Route::get('/categories.html', 'Category\CategoriesController@index');
    Route::get('/add-categories.html', 'Category\CategoriesController@addCategory');
    Route::post('/add-categories.html', 'Category\CategoriesController@saveCategory');
//    Route::post('/saveCategory','Category\CategoriesController@saveCategory');

    Route::get('/add-users.html', 'Auth\RegisterController@addUser');

    Route::get('/suppliers.html', 'Supplier\SuppliersController@index');
    Route::get('/add-suppliers.html', 'Supplier\SuppliersController@addSupplier');
    Route::post('/add-suppliers.html', 'Supplier\SuppliersController@saveSupplier');

    Route::get('/customers.html', 'Customer\CustomersController@index');
    Route::get('/add-customers.html', 'Customer\CustomersController@addCustomer');
    Route::post('/add-customers.html', 'Customer\CustomersController@saveCustomer');

    Route::get('/purchase.html', 'Purchase\PurchaseController@index');
    Route::post('/purchase.html', 'PurchaseReturn\PurchaseReturnController@savePurchaseReturns');
    Route::get('/add-purchase.html', 'Purchase\PurchaseController@addPurchase');
    Route::post('/add-purchase.html', 'Purchase\PurchaseController@savePurchase');

    Route::get('/sales.html', 'Sales\SalesController@index');
    Route::post('/sales.html', 'SalesReturn\SalesReturnController@saveSalesReturns');
    Route::get('/add-sales.html', 'Sales\SalesController@addSales');
    Route::post('/add-sales.html', 'Sales\SalesController@saveSales');


    Route::get('/stocks.html', 'Ledger\LedgerController@getTotalStockBalance');
    Route::get('/stocks/{id}', 'Ledger\LedgerController@getIndividualItemEntries');

    Route::get('/item/{id}', 'Ledger\LedgerController@getIndividualDebitEntries');

    Route::get('/transactions.html', 'Transaction\TransactionController@getTransactions');
    Route::get('/transactions/{id}', 'Transaction\TransactionController@getTransactions');


    Route::get('/purchaseReturns/{id}', 'PurchaseReturn\PurchaseReturnController@getPurchaseReturns');
    Route::get('/purchaseReturns.html', 'PurchaseReturn\PurchaseReturnController@getPurchaseReturns');
    Route::post('/purchaseReturns', 'PurchaseReturn\PurchaseReturnController@savePurchaseReturns');

    Route::get('/salesReturns/{id}', 'SalesReturn\SalesReturnController@getSalesReturns');
    Route::get('/salesReturns.html', 'SalesReturn\SalesReturnController@getSalesReturns');
    Route::post('/salesReturns', 'SalesReturn\SalesReturnController@saveSalesReturns');


    Route::get('/reports.html', 'Reports\ReportsController@index');
    Route::post('/reports.html', 'Reports\ReportsController@saveReports');


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