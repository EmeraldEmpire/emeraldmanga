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
DB::enableQueryLog();
// DB::getQueryLog();

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	// ============ Manga ============

	Route::get('/manga', [
		'as' => 'admin.home',
		'uses' => 'MangaController@adminIndex'
	]);

	Route::post('/manga', [
		'as' => 'admin.store.manga',
		'uses' => 'MangaController@adminStoreManga'
	]);

	Route::get('/manga/create', [
		'as' => 'admin.create.manga',
		'uses' => 'MangaController@adminCreateManga'
	]);

	Route::get('/manga/{slug}', [
		'as' => 'admin.show.manga',
		'uses' => 'MangaController@adminShowManga'
	]);

	Route::post('/manga/{slug}', [
		'as' => 'admin.update.manga',
		'uses' => 'MangaController@adminUpdateManga'
	]);

	Route::post('/manga/{slug}/delete', [
		'as' => 'admin.delete.manga',
		'uses' => 'MangaController@adminDeleteManga'
	]);

	Route::get('/manga/{slug}/edit', [
		'as' => 'admin.edit.manga',
		'uses' => 'MangaController@adminEditManga'
	]);

	// ============ Manga End ============

	// ============ Chapter Start ============

	Route::post('/manga/{slug}/chapters', [
		'as' => 'admin.store.chapter',
		'uses' => 'ChapterController@adminStoreChapter'
	]);

	Route::get('/manga/{slug}/chapters/create', [
		'as' => 'admin.create.chapter',
		'uses' => 'ChapterController@adminCreateChapter'
	]);

	Route::get('/manga/{slug}/{num_slug}', [
		'as' => 'admin.view.thumb',
		'uses' => 'ChapterController@adminViewThumb'
	]);

	Route::post('/manga/{slug}/{num_slug}', [
		'as' => 'admin.update.chapter',
		'uses' => 'ChapterController@adminUpdateChapter'
	]);

	Route::post('/manga/{slug}/{num_slug}/delete', [
		'as' => 'admin.delete.chapter',
		'uses' => 'ChapterController@adminDeleteChapter'
	]);

	Route::get('/manga/{slug}/{num_slug}/edit', [
		'as' => 'admin.edit.chapter',
		'uses' => 'ChapterController@adminEditChapter'
	]);

	// ============ Chapter End ============

	// ============ Genre Start ============

	Route::get('/genres', [
	'as' => 'admin.index.genre',
	'uses' => 'GenreController@adminIndexGenre'
	]);

	Route::post('/genres', [
		'as' => 'admin.store.genre',
		'uses' => 'GenreController@adminStoreGenre'
	]);

	Route::put('/genres/{id}', [
		'as' => 'admin.update.genre',
		'uses' => 'GenreController@adminUpdateGenre'
	]);

	Route::delete('/genres/{id}', [
		'as' => 'admin.delete.genre',
		'uses' => 'GenreController@adminDeleteGenre'
	]);

});





Route::get('/tester', function () {

	$query = request('search');

	$results = \App\Genre::where('name', 'like', '%'.$query.'%')->get();

	return $results;

});


Route::get('/tester2', function () {

	

});


