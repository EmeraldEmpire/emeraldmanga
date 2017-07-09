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
	Route::get('/', 'MangaController@adminIndex')->name('admin.home');
	Route::get('/create/manga', 'MangaController@adminCreateManga')->name('admin.create.manga');
	Route::post('/create/manga', 'MangaController@adminStoreManga')->name('admin.store.manga');
	Route::get('/categories', 'CategoryController@adminViewCategories')->name('admin.view.categories');
	Route::get('/categories/add', 'CategoryController@adminAddCategories')->name('admin.add.categories');
	Route::get('/categories/edit', 'CategoryController@adminEditCategories')->name('admin.edit.categories');
	Route::get('/{slug}', 'MangaController@adminShowManga')->name('admin.show.manga');
	Route::get('/{slug}/upload', 'ChapterController@adminUploadChapter')->name('admin.upload.chapter');
	Route::post('/{slug}/upload', 'ChapterController@adminStoreChapter')->name('admin.store.chapter');
	Route::get('/thumb/{slug}/{cnum}', 'ChapterController@adminViewThumb')->name('admin.view.thumb');
	
});


