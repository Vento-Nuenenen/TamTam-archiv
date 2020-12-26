<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/overwatch', 301);

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::any('/overwatch', 'OverwatchController@index')->name('overwatch');

    Route::any('/participations', 'ParticipationsController@index')->name('participations');
    Route::get('/participations/add', 'ParticipationsController@create')->name('add-participations');
    Route::post('/participations/store', 'ParticipationsController@store')->name('store-participations');
    Route::post('participations/import', 'ParticipationsController@import')->name('import-participations');
    Route::get('/participations/edit/{pid}', 'ParticipationsController@edit')->name('edit-participations');
    Route::post('/participations/update/{pid}', 'ParticipationsController@update')->name('update-participations');
    Route::get('/participations/destroy/{pid}', 'ParticipationsController@destroy')->name('destroy-participations');

    Route::any('/users', 'UsersController@index')->name('users');
    Route::get('/users/add', 'UsersController@create')->name('add-users');
    Route::post('/users/store', 'UsersController@store')->name('store-users');
    Route::get('/users/edit/{uid}', 'UsersController@edit')->name('edit-users');
    Route::post('/users/update/{uid}', 'UsersController@update')->name('update-users');
    Route::get('/users/destroy/{uid}', 'UsersController@destroy')->name('destroy-users');

    Route::any('/groups', 'GroupsController@index')->name('groups');
    Route::get('/groups/add', 'GroupsController@create')->name('add-groups');
    Route::post('/groups/store', 'GroupsController@store')->name('store-groups');
    Route::get('/groups/edit/{gid}', 'GroupsController@edit')->name('edit-groups');
    Route::post('/groups/update/{gid}', 'GroupsController@update')->name('update-groups');
    Route::get('/groups/destroy/{gid}', 'GroupsController@destroy')->name('destroy-groups');

    Route::any('/points', 'CurrentPointsController@index')->name('points');
    Route::get('/points/add', 'CurrentPointsController@create')->name('add-points');
    Route::post('/points/store', 'CurrentPointsController@store')->name('store-points');

    Route::any('/transactions', 'PointTransactionController@index')->name('transactions');
    Route::get('/transactions/add', 'PointTransactionController@create')->name('add-transactions');
    Route::post('/transactions/store', 'PointTransactionController@store')->name('store-transactions');
    Route::get('/transactions/edit/{trid}', 'PointTransactionController@edit')->name('edit-transactions');
    Route::post('/transactions/update/{trid}', 'PointTransactionController@update')->name('update-transactions');
    Route::get('/transactions/destroy/{trid}', 'PointTransactionController@destroy')->name('destroy-transactions');

    Route::any('/numbers', 'EmergencyNumbersController@index')->name('numbers');
    Route::get('/numbers/add', 'EmergencyNumbersController@create')->name('add-numbers');
    Route::post('/numbers/store', 'EmergencyNumbersController@store')->name('store-numbers');
    Route::get('/numbers/edit/{nid}', 'EmergencyNumbersController@edit')->name('edit-numbers');
    Route::post('/numbers/update/{nid}', 'EmergencyNumbersController@update')->name('update-numbers');
    Route::get('/numbers/destroy/{nid}', 'EmergencyNumbersController@destroy')->name('destroy-numbers');
    Route::post('/numbers/sort', 'EmergencyNumbersController@sort')->name('sort-numbers');

    Route::any('/sales', 'SalesController@index')->name('sales');
    Route::get('/sales/add', 'SalesController@create')->name('add-sales');
    Route::post('/sales/store', 'SalesController@store')->name('store-sales');
    Route::get('/sales/edit/{nid}', 'SalesController@edit')->name('edit-sales');
    Route::post('/sales/update/{nid}', 'SalesController@update')->name('update-sales');
    Route::get('/sales/destroy/{nid}', 'SalesController@destroy')->name('destroy-sales');

    Route::any('/items', 'ItemsController@index')->name('items');
    Route::get('/items/add', 'ItemsController@create')->name('add-items');
    Route::post('/items/store', 'ItemsController@store')->name('store-items');
    Route::get('/items/edit/{nid}', 'ItemsController@edit')->name('edit-items');
    Route::post('/items/update/{nid}', 'ItemsController@update')->name('update-items');
    Route::get('/items/destroy/{nid}', 'ItemsController@destroy')->name('destroy-items');

    Route::any('/gratulation', 'GratulationPrintController@index')->name('gratulation');
    Route::any('/gratulation/print', 'GratulationPrintController@export')->name('print-gratulation');

    Route::any('/id', 'IdentificationPrintController@index')->name('identification');
    Route::any('/id/print', 'IdentificationPrintController@export')->name('print-identification');

    Route::any('/passed', 'PassedController@index')->name('passed');
    Route::any('/passed/do', 'PassedController@set_flag')->name('do-passed');
});
