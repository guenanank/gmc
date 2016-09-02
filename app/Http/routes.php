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

Route::get('a/{id}', function($id) {
   $audience = App\AudienceLayer::select('audienceLayerResponse')->where('layerId', $id)->first();
   dd($audience->audienceLayerResponse);
});

Route::get('/', 'DashboardController@index');
Route::get('dashboard', 'DashboardController@index');

Route::group(['prefix' => 'audience'], function() {
    
    Route::resource('layerQuestion', 'LayerController');
    Route::get('layerQuestion/l/{id}', 'LayerController@layer');
    Route::post('layerQuestion/bootgrid', 'LayerController@bootgrid');

    Route::resource('question', 'QuestionController');
    Route::post('question/bootgrid', 'QuestionController@bootgrid');
    
    Route::resource('audience', 'AudienceController');
    Route::post('audience/bootgrid', 'AudienceController@bootgrid');
    Route::post('audience/validate', 'AudienceController@validateAudienceLayer');
    
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
    
    Route::resource('mediaType', 'MediaTypeController');
    Route::post('mediaType/bootgrid', 'MediaTypeController@bootgrid');

    Route::resource('profession', 'ProfessionController');
    Route::post('profession/bootgrid', 'ProfessionController@bootgrid');

    Route::resource('source', 'SourceController');
    Route::post('source/bootgrid', 'SourceController@bootgrid');
    
});
