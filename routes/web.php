<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('verify','Auth\RegisterController@verifyEmail')->name('verify');

Route::group([ 
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth','admin']
], function () {
    Route::get('/', function () {
        return redirect('admin/poll');
    });

    Route::resource('/poll',Poll\PollsController::class);
    
    Route::get('/organizaion','Admin\OrganizationController@index')->name('organization');

    Route::put('/choice/{key}', 'VotesController@vote');

    Route::post('/poll/{poll}?action=close', 'Poll\PollsController@update')->name('poll.close');

    Route::get('/poll/{id}/result', 'Poll\PollsController@result')->name('poll.result');

});

Route::group([
    'prefix' => 'member',
    'as' => 'member.',
    'middleware' => ['auth','member']
], function () {
    Route::get('/', function () {
        return redirect('member/poll');
    });
    Route::resource('/poll', Poll\PollsController::class);

    Route::put('/choice/{key}', 'VotesController@vote');

    Route::get('/poll/{id}/result', 'Poll\PollsController@result')->name('poll.result');


});


//Route::get('/dashboard', [App\Http\Controllers\Test\TestController::class, 'index'])->name('dashboard');
