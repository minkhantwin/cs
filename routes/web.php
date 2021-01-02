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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth','admin']
], function () {
    Route::get('/','DashboardController@index')->name('dashboard');
    Route::get('/organizaion','OrganizationController@index')->name('organization');

    Route::resource('/poll',PollsController::class);

});

Route::group([
    'prefix' => 'member',
    'as' => 'member.',
    'namespace' => 'Member',
    'middleware' => ['auth','member']
], function () {
    Route::get('/','HomeController@index')->name('home');
    

});


//Route::get('/dashboard', [App\Http\Controllers\Test\TestController::class, 'index'])->name('dashboard');
