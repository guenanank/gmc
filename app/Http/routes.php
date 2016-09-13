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

Route::get('/', 'DashboardController@index');
Route::get('dashboard', 'DashboardController@index');

Route::group(['prefix' => 'audience'], function() {
    
    Route::resource('layerQuestion', 'LayerController');
    Route::get('layerQuestion/l/{id}', 'LayerController@layer')->name('audience.layerQuestion.layer');
    Route::post('layerQuestion/bootgrid', 'LayerController@bootgrid')->name('audience.layerQuestion.bootgrid');

    Route::resource('question', 'QuestionController');
    Route::post('question/bootgrid', 'QuestionController@bootgrid')->name('audience.question.upload');
    
    Route::get('audience/upload', 'AudienceController@upload')->name('audience.audience.upload');
    Route::resource('audience', 'AudienceController');
    Route::post('audience/bootgrid', 'AudienceController@bootgrid')->name('audience.audience.bootgrid');
    Route::post('audience/validate', 'AudienceController@validateAudienceLayer')->name('audience.audience.validate');
    
});

Route::group(['prefix' => 'master'], function() {

    Route::resource('activity', 'ActivityController');
    Route::post('activity/bootgrid', 'ActivityController@bootgrid')->name('master.activity.bootgrid');

    Route::resource('education', 'EducationController');
    Route::post('education/bootgrid', 'EducationController@bootgrid')->name('master.education.bootgrid');

    Route::resource('expense', 'ExpenseController');
    Route::post('expense/bootgrid', 'ExpenseController@bootgrid')->name('master.expense.bootgrid');

    Route::resource('hobby', 'HobbyController');
    Route::post('hobby/bootgrid', 'HobbyController@bootgrid')->name('master.hobby.bootgrid');

    Route::resource('interest', 'InterestController');
    Route::post('interest/bootgrid', 'InterestController@bootgrid')->name('master.interest.bootgrid');

    Route::resource('media', 'MediaController');
    Route::post('media/bootgrid', 'MediaController@bootgrid')->name('master.media.bootgrid');

    Route::resource('mediaGroup', 'MediaGroupController');
    Route::post('mediaGroup/bootgrid', 'MediaGroupController@bootgrid')->name('master.mediaGroup.bootgrid');

    Route::resource('profession', 'ProfessionController');
    Route::post('profession/bootgrid', 'ProfessionController@bootgrid')->name('master.profession.bootgrid');

    Route::resource('source', 'SourceController');
    Route::post('source/bootgrid', 'SourceController@bootgrid')->name('master.source.bootgrid');
    
});
