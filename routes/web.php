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

// For Testings
// DB::enableQueryLog();
// DB::getQueryLog();



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

require('internal-api/admin.php');








// For Testings

Route::get('/tester', function () {

	$query = request('search');

	$results = \App\Genre::where('name', 'like', '%'.$query.'%')->get();

	return $results;

});


Route::get('/tester2', function () {

	

});