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

Route::redirect('/', '/overwatch', 301);

Auth::routes();

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

    Route::any('/fields', 'FieldsController@index')->name('fields');
    Route::get('/fields/add', 'FieldsController@create')->name('add-fields');
    Route::post('/fields/store', 'FieldsController@store')->name('store-fields');
    Route::get('/fields/edit/{fid}', 'FieldsController@edit')->name('edit-fields');
    Route::post('/fields/update/{fid}', 'FieldsController@update')->name('update-fields');
    Route::get('/fields/destroy/{fid}', 'FieldsController@destroy')->name('destroy-fields');

    Route::any('/points', 'CurrentPointsController@index')->name('points');
    Route::get('/points/add', 'CurrentPointsController@create')->name('add-points');
    Route::post('/points/store', 'CurrentPointsController@store')->name('store-points');

	Route::any('/transactions', 'CurrentPointsController@index')->name('points');
	Route::get('/transactions/edit/{poid}', 'CurrentPointsController@edit')->name('edit-points');
	Route::post('/transactions/update/{poid}', 'CurrentPointsController@update')->name('update-points');
	Route::get('/transactions/destroy/{poid}', 'CurrentPointsController@destroy')->name('destroy-points');

	Route::any('/numbers', 'EmergencyController@index')->name('numbers');
	Route::get('/numbers/add', 'EmergencyController@create')->name('add-numbers');
	Route::post('/numbers/store', 'EmergencyController@store')->name('store-numbers');
	Route::get('/numbers/edit/{nid}', 'EmergencyController@edit')->name('edit-numbers');
	Route::post('/numbers/update/{nid}', 'EmergencyController@update')->name('update-numbers');
	Route::get('/numbers/destroy/{nid}', 'EmergencyController@destroy')->name('destroy-numbers');

	Route::any('/gratulation', 'GratulationPrintController@index')->name('gratulation');
	Route::any('/gratulation/print', 'GratulationPrintController@export')->name('print-gratulation');

	Route::any('/id', 'IdentificationPrintController@index')->name('identification');
	Route::any('/id/print', 'IdentificationPrintController@export')->name('print-identification');
});
