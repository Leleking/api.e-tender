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

//admin routes
Route::group(['prefix'=>'admin','middleware'=>['auth:api']],function(){
    Route::group(['prefix'=>'project'],function(){
        Route::post('create','project\projectController@postProject');
        Route::get('view/all','project\projectController@viewAllProjects');
        Route::get('view/due','project\projectController@viewProjectsDue');
        Route::get('completed','project\projectController@viewCompletedProjects');
        Route::get('calender','project\projectController@getProjectCalender');
        Route::get('bids/{id}','bid\bidController@getProjectBids');
    });
    Route::group(['prefix'=>'contractors'],function(){
        Route::get('','contractorController@index');
    });
    Route::group(['prefix'=>'grant'],function(){
        Route::get('interview','bid\bidController@grantInterview');
    });
});
Route::get('testsms',function(){
    $phone = '233248574526';
    $send = new sendSMSController();
    $send->key = "taConV0E1Fu0ibY5leaQXCon9";
    $send->message ="Hello  Martins Food and Dine, you are hereby invited by the PPA ";
    $send->numbers = $phone;
    $send->sender = "Vector";
    $isError = true;
    $response = $send->sendMessage();
    echo $response;

});
Route::post('postMedia','bid\bidController@test');

