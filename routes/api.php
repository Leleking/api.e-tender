<?php

use Illuminate\Http\Request;
use App\Http\Controllers\sendSMSController;

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
Route::post('/user/signup',"user\signUpController@store");
Route::middleware('auth:api')->post('/register', "Auth\RegisterController@create");
Route::group(['prefix'=>'project','middleware'=>'auth:api'],function(){
    Route::get('getProjects','project\projectController@getProjects');
    Route::get('{id}','project\projectController@getProjectDetails');
    Route::get('project_rules','project\projectController@getProjectRules');
    Route::get('category/{name}','project\projectController@getProjectsByCategory');
    Route::post('search','project\projectController@searchProject');
    
});
Route::group(['prefix'=>'user','middleware'=>'auth:api'],function(){
    Route::get('bids','bid\bidController@userBids');
    Route::get('bids/completed','bid\bidController@userCompletedBids');
    Route::get('project_rules','project\projectController@getProjectRules');
});

Route::get('admin/project/completed','project\projectController@viewCompletedProjects');
Route::get('admin/project/calender','project\projectController@getProjectCalender');
Route::get('admin/project/bids/{id}','bid\bidController@getProjectBids');
Route::get('admin/project/linechart','project\projectController@getLineChart');
//admin routes
Route::group(['prefix'=>'admin','middleware'=>['auth:api']],function(){
    Route::group(['prefix'=>'project'],function(){
        Route::get('{id}','project\projectController@getProject');
        Route::post('create','project\projectController@postProject');
       Route::get('view/all','project\projectController@viewAllProjects');
        Route::get('view/due','project\projectController@viewProjectsDue');
        
    });
    Route::group(['prefix'=>'contractors'],function(){
        Route::get('','contractorController@index');
    });
    Route::group(['prefix'=>'grant'],function(){
        Route::post('interview','bid\bidController@grantInterview');
    });
});
Route::post('postMedia','bid\bidController@test');

