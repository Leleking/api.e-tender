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
Route::get('test',function(){
    return response([1,2,3],200);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'project','middleware'=>'auth:api'],function(){
    Route::get('getProjects','project\projectController@getProjects');
    Route::get('{id}','project\projectController@getProjectDetails');
    Route::get('project_rules','project\projectController@getProjectRules');
    Route::get('category/{name}','project\projectController@getProjectsByCategory');
    
});
Route::group(['prefix'=>'user','middleware'=>'auth:api'],function(){
    Route::get('bids','bid\bidController@userBids');
    Route::get('project_rules','project\projectController@getProjectRules');
});

//admin routes
Route::group(['prefix'=>'admin','middleware'=>['auth:api']],function(){
    Route::group(['prefix'=>'project'],function(){
        Route::post('create','project\projectController@postProject');
        Route::get('view/all','project\projectController@viewAllProjects');
        Route::get('completed','project\projectController@viewCompletedProjects');
        Route::get('calender','project\projectController@getProjectCalender');
    });
});
Route::post('postMedia','bid\bidController@test');

