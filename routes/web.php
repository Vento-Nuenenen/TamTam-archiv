<?php

use App\Http\Controllers\CurrentPointsController;
use App\Http\Controllers\EmergencyNumbersController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OverwatchController;
use App\Http\Controllers\ParticipationsController;
use App\Http\Controllers\PassedController;
use App\Http\Controllers\PointTransactionController;
use App\Http\Controllers\PrintGratulationController;
use App\Http\Controllers\PrintIdentificationController;
use App\Http\Controllers\PrintPricelistController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/overwatch', 301);

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::any('/overwatch', [OverwatchController::class, 'index'])->name('overwatch');

    Route::any('/participations', [ParticipationsController::class, 'index'])->name('participations');
    Route::get('/participations/add', [ParticipationsController::class, 'create'])->name('add-participations');
    Route::post('/participations/store', [ParticipationsController::class, 'store'])->name('store-participations');
    Route::post('participations/import', [ParticipationsController::class, 'import'])->name('import-participations');
    Route::get('/participations/edit/{pid}', [ParticipationsController::class, 'edit'])->name('edit-participations');
    Route::post('/participations/update/{pid}', [ParticipationsController::class, 'update'])->name('update-participations');
    Route::get('/participations/destroy/{pid}', [ParticipationsController::class, 'destroy'])->name('destroy-participations');

    Route::any('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/users/add', [UsersController::class, 'create'])->name('add-users');
    Route::post('/users/store', [UsersController::class, 'store'])->name('store-users');
    Route::get('/users/edit/{uid}', [UsersController::class, 'edit'])->name('edit-users');
    Route::post('/users/update/{uid}', [UsersController::class, 'update'])->name('update-users');
    Route::get('/users/destroy/{uid}', [UsersController::class, 'destroy'])->name('destroy-users');

    Route::any('/groups', [GroupsController::class, 'index'])->name('groups');
    Route::get('/groups/add', [GroupsController::class, 'create'])->name('add-groups');
    Route::post('/groups/store', [GroupsController::class, 'store'])->name('store-groups');
    Route::get('/groups/edit/{gid}', [GroupsController::class, 'edit'])->name('edit-groups');
    Route::post('/groups/update/{gid}', [GroupsController::class, 'update'])->name('update-groups');
    Route::get('/groups/destroy/{gid}', [GroupsController::class, 'destroy'])->name('destroy-groups');

    Route::any('/points', [CurrentPointsController::class, 'index'])->name('points');
    Route::get('/points/add', [CurrentPointsController::class, 'create'])->name('add-points');
    Route::post('/points/store', [CurrentPointsController::class, 'store'])->name('store-points');

    Route::any('/transactions', [PointTransactionController::class, 'index'])->name('transactions');
    Route::get('/transactions/add', [PointTransactionController::class, 'create'])->name('add-transactions');
    Route::post('/transactions/store', [PointTransactionController::class, 'store'])->name('store-transactions');
    Route::get('/transactions/edit/{trid}', [PointTransactionController::class, 'edit'])->name('edit-transactions');
    Route::post('/transactions/update/{trid}', [PointTransactionController::class, 'update'])->name('update-transactions');
    Route::get('/transactions/destroy/{trid}', [PointTransactionController::class, 'destroy'])->name('destroy-transactions');

    Route::any('/numbers', [EmergencyNumbersController::class, 'index'])->name('numbers');
    Route::get('/numbers/add', [EmergencyNumbersController::class, 'create'])->name('add-numbers');
    Route::post('/numbers/store', [EmergencyNumbersController::class, 'store'])->name('store-numbers');
    Route::get('/numbers/edit/{nid}', [EmergencyNumbersController::class, 'edit'])->name('edit-numbers');
    Route::post('/numbers/update/{nid}', [EmergencyNumbersController::class, 'update'])->name('update-numbers');
    Route::get('/numbers/destroy/{nid}', [EmergencyNumbersController::class, 'destroy'])->name('destroy-numbers');
    Route::post('/numbers/sort', [EmergencyNumbersController::class, 'sort'])->name('sort-numbers');

    Route::any('/sales', [SalesController::class, 'index'])->name('sales');
    Route::post('/sales/store', [SalesController::class, 'store'])->name('store-sales');
    Route::post('/sales/lookup', [SalesController::class, 'lookup'])->name('lookup-sales');

    Route::any('/items', [ItemsController::class, 'index'])->name('items');
    Route::get('/items/add', [ItemsController::class, 'create'])->name('add-items');
    Route::post('/items/store', [ItemsController::class, 'store'])->name('store-items');
    Route::get('/items/edit/{nid}', [ItemsController::class, 'edit'])->name('edit-items');
    Route::post('/items/update/{nid}', [ItemsController::class, 'update'])->name('update-items');
    Route::get('/items/destroy/{nid}', [ItemsController::class, 'destroy'])->name('destroy-items');

    Route::any('/gratulation', [PrintGratulationController::class, 'index'])->name('gratulation');
    Route::any('/gratulation/print', [PrintGratulationController::class, 'export'])->name('print-gratulation');

    Route::any('/id', [PrintIdentificationController::class, 'index'])->name('identification');
    Route::any('/id/print', [PrintIdentificationController::class, 'print'])->name('print-identification');

    Route::any('/passed', [PassedController::class, 'index'])->name('passed');
    Route::any('/passed/do', [PassedController::class, 'set_flag'])->name('do-passed');

    Route::any('/pricelist', [PrintPricelistController::class, 'index'])->name('pricelist');
    Route::any('/pricelist/print', [PrintPricelistController::class, 'print'])->name('print-pricelist');
});
