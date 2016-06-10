<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('dashboard', 'DashboardController@index');

Route::group(['prefix' => 'audience'], function() {
    
    Route::resource('audienceType', 'AudienceTypeController');
    Route::post('audienceType/bootgrid', 'AudienceTypeController@bootgrid');
    
    Route::resource('layerQuestion', 'LayerQuestionController');
    Route::post('layerQuestion/bootgrid', 'LayerQuestionController@bootgrid');
    
    Route::resource('audience', 'AudienceController');
    Route::post('audience/bootgrid', 'AudienceController@bootgrid');
    
});

Route::group(['prefix' => 'master'], function() {

    Route::resource('activity', 'ActivityController');
    Route::post('activity/bootgrid', 'ActivityController@bootgrid');

    Route::resource('education', 'EducationController');
    Route::post('education/bootgrid', 'EducationController@bootgrid');

    Route::resource('expense', 'ExpenseController');
    Route::post('expense/bootgrid', 'ExpenseController@bootgrid');

    Route::resource('hobby', 'HobbyController');
    Route::post('hobby/bootgrid', 'HobbyController@bootgrid');

    Route::resource('interest', 'InterestController');
    Route::post('interest/bootgrid', 'InterestController@bootgrid');

    Route::resource('media', 'MediaController');
    Route::post('media/bootgrid', 'MediaController@bootgrid');

    Route::resource('mediaGroup', 'MediaGroupController');
    Route::post('mediaGroup/bootgrid', 'MediaGroupController@bootgrid');

    Route::resource('profession', 'ProfessionController');
    Route::post('profession/bootgrid', 'ProfessionController@bootgrid');

    Route::resource('source', 'SourceController');
    Route::post('source/bootgrid', 'SourceController@bootgrid');
    
});
