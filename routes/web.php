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

Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['role:admin|writer|guest']], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('profiles', 'ProfilesController');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['role:admin|writer']], function () {
    Route::resource('articles', 'ArticlesController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::resource('memos', 'MemosController');
    Route::get('memos/{memo}/create', 'MemosController@create')->name('memos.create_child');
    Route::get('memos/tag/{id}', 'MemosController@tag')->name('memos.tag');
    Route::get('memos/thread/list', 'MemosController@thread')->name('memos.thread');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['role:admin']], function () {
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
});

Route::group(['middleware' => ['role:writer']], function () {
});

// Not Login User
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {
    Route::get('/', 'FrontendController@index');
    Route::get('articles/index', 'ArticlesController@index')->name('articles.index');
    Route::get('articles/show/{article}', 'ArticlesController@show')->name('articles.show');
    Route::get('articles/category/{category}', 'ArticlesController@category')->name('articles.category');
});
// Route::get('/', function () {
//     // return view('welcome');
// });


// Route::get('/home', 'HomeController@index')->name('home');
