<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('operations', 'PaginasController@operations');

/*
 * AJAX Routes
 */

Route::get('queryResult', function() {
    return View::make('index');
});

Route::post('queryResult', 'QueryController@queryResult');
