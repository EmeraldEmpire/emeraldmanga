<?php


Route::group([
		'prefix' => 'admin', 
		'middleware' => 'auth',
		'namespace' => 'Admin'], function () {

	// ============ Manga ============

	Route::get('/manga', [
		'as' => 'admin.home',
		'uses' => 'MangaController@index'
	]);

	Route::post('/manga', [
		'as' => 'admin.store.manga',
		'uses' => 'MangaController@store'
	]);

	Route::get('/manga/{manga}', [
		'as' => 'admin.show.manga',
		'uses' => 'MangaController@show'
	]);

	Route::post('/manga/{manga}', [
		'as' => 'admin.update.manga',
		'uses' => 'MangaController@update'
	]);

	Route::delete('/manga/{manga}', [
		'as' => 'admin.delete.manga',
		'uses' => 'MangaController@destroy'
	]);

	// ============ Manga End ============

	// ============ Chapter Start ============

	Route::post('/manga/{manga}/chapters', [
		'as' => 'admin.store.chapter',
		'uses' => 'ChapterController@store'
	]);

	Route::get('/manga/{manga}/chapters/{chapter}', [
		'as' => 'admin.show.chapter',
		'uses' => 'ChapterController@index'
	]);

	Route::delete('/manga/{manga}/chapters/{chapter}', [
		'as' => 'admin.delete.chapter',
		'uses' => 'ChapterController@destroy'
	]);

	// ============ Chapter End ============

	// ============ Genre Start ============

	Route::get('/genres', [
	'as' => 'admin.index.genre',
	'uses' => 'GenreController@index'
	]);

	Route::post('/genres', [
		'as' => 'admin.store.genre',
		'uses' => 'GenreController@store'
	]);

	Route::put('/genres/{genre}', [
		'as' => 'admin.update.genre',
		'uses' => 'GenreController@update'
	]);

	Route::delete('/genres/{genre}', [
		'as' => 'admin.delete.genre',
		'uses' => 'GenreController@destroy'
	]);

});