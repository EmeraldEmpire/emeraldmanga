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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
	//home
	Route::get('/', 'MangaController@adminIndex')->name('admin.home');

	//create
	Route::get('/create/manga', 'MangaController@adminCreateManga')->name('admin.create.manga');
	Route::get('/{slug}/upload', 'ChapterController@adminUploadChapter')->name('admin.upload.chapter');
	Route::get('/categories/add', 'CategoryController@adminAddCategories')->name('admin.add.categories');

	//store
	Route::post('/{slug}/upload', 'ChapterController@adminStoreChapter')->name('admin.store.chapter');
	Route::post('/categories/add', 'CategoryController@adminStoreCategories')->name('admin.store.categories');
	Route::post('/create/manga', 'MangaController@adminStoreManga')->name('admin.store.manga');

	//edit
	Route::get('/edit/{slug}', 'MangaController@adminEditManga')->name('admin.edit.manga');
	Route::get('/categories/edit', 'CategoryController@adminEditCategories')->name('admin.edit.categories');

	//update
	Route::post('/edit/{slug}', 'MangaController@adminUpdateManga')->name('admin.update.manga');

	//delete
	Route::post('/delete/manga/{slug}', 'MangaController@adminDeleteManga')->name('admin.delete.manga');

	//view all
	Route::get('/categories', 'CategoryController@adminViewCategories')->name('admin.view.categories');
	
	//show
	Route::get('/{slug}', 'MangaController@adminShowManga')->name('admin.show.manga');
	Route::get('/thumb/{slug}/{cnum}', 'ChapterController@adminViewThumb')->name('admin.view.thumb');
	
});


