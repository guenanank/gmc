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

//Route::group(['prefix' => 'audience'], function() {
//    
//    Route::resource('layerQuestion', 'LayerController');
//    Route::get('layerQuestion/l/{id}', 'LayerController@layer')->name('audience.layerQuestion.layer');
//    Route::post('layerQuestion/bootgrid', 'LayerController@bootgrid')->name('audience.layerQuestion.bootgrid');
//
//    Route::resource('question', 'QuestionController');
//    Route::post('question/bootgrid', 'QuestionController@bootgrid')->name('audience.question.bootgrid');
//    
//    //Route::resource('upload', 'UploadController');
//    Route::get('upload', 'UploadController@index')->name('audience.upload');
//    Route::put('upload', 'UploadController@store')->name('audience.upload.store');
//    
//    Route::resource('audience', 'AudienceController');
//    Route::post('audience/bootgrid', 'AudienceController@bootgrid')->name('audience.audience.bootgrid');
//    Route::post('audience/validate', 'AudienceController@validateAudienceLayer')->name('audience.audience.validate');
//    
//});

Route::resource('master/audience', 'AudienceController');

Route::group(['prefix' => 'layerQuestion'], function() {
    Route::get('/', ['uses' => 'LayerController@index', 'as' => 'layerQuestion.index']);
    Route::post('bootgrid', ['uses' => 'LayerController@bootgrid', 'as' => 'layerQuestion.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'LayerController@create', 'as' => 'layerQuestion.create']);
    Route::post('store', ['uses' => 'LayerController@store', 'as' => 'layerQuestion.store', 'middleware' => 'ajax']);
    Route::get('{layerId}/edit', ['uses' => 'LayerController@edit','as' => 'layerQuestion.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{layerId}', ['uses' => 'LayerController@update', 'as' => 'layerQuestion.update', 'middleware' => 'ajax']);
    Route::delete('{layerId}', ['uses' => 'LayerController@delete', 'as' => 'layerQuestion.delete']);
    Route::get('l/{id}', ['uses' => 'LayerController@layer', 'as' => 'layerQuestion.layer']);
});

Route::group(['prefix' => 'question'], function() {
    Route::get('/', ['uses' => 'QuestionController@index', 'as' => 'question.index']);
    Route::post('bootgrid', ['uses' => 'QuestionController@bootgrid', 'as' => 'question.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'QuestionController@create', 'as' => 'question.create']);
    Route::post('store', ['uses' => 'QuestionController@store', 'as' => 'question.store', 'middleware' => 'ajax']);
    Route::get('{questionId}/edit', ['uses' => 'QuestionController@edit','as' => 'question.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{questionId}', ['uses' => 'QuestionController@update', 'as' => 'question.update', 'middleware' => 'ajax']);
    Route::delete('{questionId}', ['uses' => 'QuestionController@delete', 'as' => 'question.delete']);
});

Route::group(['prefix' => 'audience'], function() {
    Route::get('/', ['uses' => 'AudienceController@index', 'as' => 'audience.index']);
    Route::post('bootgrid', ['uses' => 'AudienceController@bootgrid', 'as' => 'audience.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'AudienceController@create', 'as' => 'audience.create']);
    Route::post('store', ['uses' => 'AudienceController@store', 'as' => 'audience.store', 'middleware' => 'ajax']);
    Route::get('{audienceId}/edit', ['uses' => 'AudienceController@edit','as' => 'audience.edit']);
    Route::get('{audienceId}', ['uses' => 'AudienceController@show','as' => 'audience.show']);
    Route::match(['PUT', 'PATCH'], 'update/{audienceId}', ['uses' => 'AudienceController@update', 'as' => 'audience.update', 'middleware' => 'ajax']);
    Route::delete('{audienceId}', ['uses' => 'AudienceController@delete', 'as' => 'audience.delete']);
    Route::post('validate', ['uses' => 'AudienceController@validateAudienceLayer', 'middleware' => 'ajax']);
});

Route::group(['prefix' => 'upload'], function() {
    Route::get('/', ['uses' => 'UploadController@index', 'as' => 'upload.index']);
    Route::post('bootgrid', ['uses' => 'UploadController@bootgrid', 'as' => 'upload.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'UploadController@create', 'as' => 'upload.create']);
    Route::post('store', ['uses' => 'UploadController@store', 'as' => 'upload.store', 'middleware' => 'ajax']);
    Route::get('{uploadId}/edit', ['uses' => 'UploadController@edit','as' => 'upload.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{uploadId}', ['uses' => 'UploadController@update', 'as' => 'upload.update', 'middleware' => 'ajax']);
    Route::delete('{uploadId}', ['uses' => 'UploadController@delete', 'as' => 'upload.delete']);
});

Route::group(['prefix' => 'activity'], function() {
    Route::get('/', ['uses' => 'ActivityController@index', 'as' => 'activity.index']);
    Route::post('bootgrid', ['uses' => 'ActivityController@bootgrid', 'as' => 'activity.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'ActivityController@create', 'as' => 'activity.create']);
    Route::post('store', ['uses' => 'ActivityController@store', 'as' => 'activity.store', 'middleware' => 'ajax']);
    Route::get('{activityId}/edit', ['uses' => 'ActivityController@edit','as' => 'activity.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{activityId}', ['uses' => 'ActivityController@update', 'as' => 'activity.update', 'middleware' => 'ajax']);
    Route::delete('{activityId}', ['uses' => 'ActivityController@delete', 'as' => 'activity.delete']);
});

Route::group(['prefix' => 'education'], function() {
    Route::get('/', ['uses' => 'EducationController@index', 'as' => 'education.index']);
    Route::post('bootgrid', ['uses' => 'EducationController@bootgrid', 'as' => 'education.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'EducationController@create', 'as' => 'education.create']);
    Route::post('store', ['uses' => 'EducationController@store', 'as' => 'education.store', 'middleware' => 'ajax']);
    Route::get('{educationId}/edit', ['uses' => 'EducationController@edit','as' => 'education.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{educationId}', ['uses' => 'EducationController@update', 'as' => 'education.update', 'middleware' => 'ajax']);
    Route::delete('{educationId}', ['uses' => 'EducationController@delete', 'as' => 'education.delete']);
});

Route::group(['prefix' => 'expense'], function() {
    Route::get('/', ['uses' => 'ExpenseController@index', 'as' => 'expense.index']);
    Route::post('bootgrid', ['uses' => 'ExpenseController@bootgrid', 'as' => 'expense.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'ExpenseController@create', 'as' => 'expense.create']);
    Route::post('store', ['uses' => 'ExpenseController@store', 'as' => 'expense.store', 'middleware' => 'ajax']);
    Route::get('{expenseId}/edit', ['uses' => 'ExpenseController@edit','as' => 'expense.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{expenseId}', ['uses' => 'ExpenseController@update', 'as' => 'expense.update', 'middleware' => 'ajax']);
    Route::delete('{expenseId}', ['uses' => 'ExpenseController@delete', 'as' => 'expense.delete']);
});

Route::group(['prefix' => 'hobby'], function() {
    Route::get('/', ['uses' => 'HobbyController@index', 'as' => 'hobby.index']);
    Route::post('bootgrid', ['uses' => 'HobbyController@bootgrid', 'as' => 'hobby.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'HobbyController@create', 'as' => 'hobby.create']);
    Route::post('store', ['uses' => 'HobbyController@store', 'as' => 'hobby.store', 'middleware' => 'ajax']);
    Route::get('{hobbyId}/edit', ['uses' => 'HobbyController@edit','as' => 'hobby.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{hobbyId}', ['uses' => 'HobbyController@update', 'as' => 'hobby.update', 'middleware' => 'ajax']);
    Route::delete('{hobbyId}', ['uses' => 'HobbyController@delete', 'as' => 'hobby.delete']);
});

Route::group(['prefix' => 'interest'], function() {
    Route::get('/', ['uses' => 'InterestController@index', 'as' => 'interest.index']);
    Route::post('bootgrid', ['uses' => 'InterestController@bootgrid', 'as' => 'interest.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'InterestController@create', 'as' => 'interest.create']);
    Route::post('store', ['uses' => 'InterestController@store', 'as' => 'interest.store', 'middleware' => 'ajax']);
    Route::get('{interestId}/edit', ['uses' => 'InterestController@edit','as' => 'interest.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{interestId}', ['uses' => 'InterestController@update', 'as' => 'interest.update', 'middleware' => 'ajax']);
    Route::delete('{interestId}', ['uses' => 'InterestController@delete', 'as' => 'interest.delete']);
});

Route::group(['prefix' => 'media'], function() {
    Route::get('/', ['uses' => 'MediaController@index', 'as' => 'media.index']);
    Route::post('bootgrid', ['uses' => 'MediaController@bootgrid', 'as' => 'media.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'MediaController@create', 'as' => 'media.create']);
    Route::post('store', ['uses' => 'MediaController@store', 'as' => 'media.store', 'middleware' => 'ajax']);
    Route::get('{mediaId}/edit', ['uses' => 'MediaController@edit','as' => 'media.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{mediaId}', ['uses' => 'MediaController@update', 'as' => 'media.update', 'middleware' => 'ajax']);
    Route::delete('{mediaId}', ['uses' => 'MediaController@delete', 'as' => 'media.delete']);
});

Route::group(['prefix' => 'mediaGroup'], function() {
    Route::get('/', ['uses' => 'MediaGroupController@index', 'as' => 'mediaGroup.index']);
    Route::post('bootgrid', ['uses' => 'MediaGroupController@bootgrid', 'as' => 'mediaGroup.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'MediaGroupController@create', 'as' => 'mediaGroup.create']);
    Route::post('store', ['uses' => 'MediaGroupController@store', 'as' => 'mediaGroup.store', 'middleware' => 'ajax']);
    Route::get('{mediaGroupId}/edit', ['uses' => 'MediaGroupController@edit','as' => 'mediaGroup.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{mediaGroupId}', ['uses' => 'MediaGroupController@update', 'as' => 'mediaGroup.update', 'middleware' => 'ajax']);
    Route::delete('{mediaGroupId}', ['uses' => 'MediaGroupController@delete', 'as' => 'mediaGroup.delete']);
});

Route::group(['prefix' => 'profession'], function() {
    Route::get('/', ['uses' => 'ProfessionController@index', 'as' => 'profession.index']);
    Route::post('bootgrid', ['uses' => 'ProfessionController@bootgrid', 'as' => 'profession.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'ProfessionController@create', 'as' => 'profession.create']);
    Route::post('store', ['uses' => 'ProfessionController@store', 'as' => 'profession.store', 'middleware' => 'ajax']);
    Route::get('{professionId}/edit', ['uses' => 'ProfessionController@edit','as' => 'profession.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{professionId}', ['uses' => 'ProfessionController@update', 'as' => 'profession.update', 'middleware' => 'ajax']);
    Route::delete('{professionId}', ['uses' => 'ProfessionController@delete', 'as' => 'profession.delete']);
});

Route::group(['prefix' => 'source'], function() {
    Route::get('/', ['uses' => 'SourceController@index', 'as' => 'source.index']);
    Route::post('bootgrid', ['uses' => 'SourceController@bootgrid', 'as' => 'source.bootgrid', 'middleware' => 'ajax']);
    Route::get('create', ['uses' => 'SourceController@create', 'as' => 'source.create']);
    Route::post('store', ['uses' => 'SourceController@store', 'as' => 'source.store', 'middleware' => 'ajax']);
    Route::get('{sourceId}/edit', ['uses' => 'SourceController@edit','as' => 'source.edit']);
    Route::match(['PUT', 'PATCH'], 'update/{sourceId}', ['uses' => 'SourceController@update', 'as' => 'source.update', 'middleware' => 'ajax']);
    Route::delete('{sourceId}', ['uses' => 'SourceController@delete', 'as' => 'source.delete']);
});
