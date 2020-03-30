<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('/list-post/{per_page}/{page}', 'BlogController@posts_with_pagination');
Route::get('/all-feature-post', 'BlogController@all_feature_posts');
Route::get('/get-post/{postid}', 'BlogController@get_post');	