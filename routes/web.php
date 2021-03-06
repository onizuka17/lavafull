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

Route::get('/', 'FrontendController@index');


//Route::get(
   // '{uri}',
   //'\\'.Pallares\LaravelNuxt\Controllers\NuxtController::class
//)->where('uri', '.*');



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/posts', 'PostsController@all_posts');
Route::get('/admin/{anypath}', 'HomeController@index')->where('anypath','.*');

Route::middleware(['auth'])->prefix('api/admin')->group(function () {

	/*CATEGORY*/
	Route::post('/add-category', 'PostTaxonomyController@add_category');

	Route::get('/category-with-subcate', 'PostTaxonomyController@cate_with_subcate');
	Route::get('/all-category', 'PostTaxonomyController@all');
	Route::get('/list-category/{per_page}/{page}', 'PostTaxonomyController@category_with_pagination');
	Route::get('/get-category/{id}', 'PostTaxonomyController@get_category');	

	Route::delete('/delete-category/{id}', 'PostTaxonomyController@delete_category');	

	Route::put('/update-category/{catid}', 'PostTaxonomyController@update_category');


	/*POST*/
	Route::post('/add-post', 'PostsController@add_post');

	Route::get('/all-post', 'PostsController@all_posts');
	Route::get('/list-post/{per_page}/{page}', 'PostsController@posts_with_pagination');
	Route::get('/get-post/{postid}', 'PostsController@get_post');	

	Route::delete('/delete-post/{postid}', 'PostsController@delete_post');	

	Route::post('/update-post/{postid}', 'PostsController@update_post');
});






