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

Route::auth();
Route::get('locked', ['uses' => 'LockScreen@get', 'as' => 'locked']);
Route::group(['before' => 'force.ssl'], function() {

    Route::get('/', ['uses' => 'Dashboard@index', 'as' => 'dashboard']);
    Route::get('dashboard/', ['uses' => 'Dashboard@index', 'as' => 'dashboard']);

    Route::group(['prefix' => 'audience'], function() {
        Route::get('/', ['uses' => 'Audience@index', 'as' => 'audience.index']);
        Route::post('bootgrid', ['uses' => 'Audience@bootgrid', 'as' => 'audience.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Audience@create', 'as' => 'audience.create']);
        Route::post('store', ['uses' => 'Audience@store', 'as' => 'audience.store', 'middleware' => 'isAjax']);
        Route::get('{audienceId}/edit', ['uses' => 'Audience@edit', 'as' => 'audience.edit']);
        Route::get('{audienceId}', ['uses' => 'Audience@show', 'as' => 'audience.show', 'middleware' => 'isAjax']);
        Route::match(['PUT', 'PATCH'], 'update/{audienceId}', ['uses' => 'Audience@update', 'as' => 'audience.update', 'middleware' => 'isAjax']);
        Route::delete('{audienceId}', ['uses' => 'Audience@destroy', 'as' => 'audience.delete']);
        Route::post('validate', ['uses' => 'Audience@validateAudienceLayer', 'as' => 'audience.validate', 'middleware' => 'isAjax']);
    });

    Route::group(['prefix' => 'layerQuestion'], function() {
        Route::get('/', ['uses' => 'Layer@index', 'as' => 'layerQuestion.index']);
        Route::post('bootgrid', ['uses' => 'Layer@bootgrid', 'as' => 'layerQuestion.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Layer@create', 'as' => 'layerQuestion.create']);
        Route::post('store', ['uses' => 'Layer@store', 'as' => 'layerQuestion.store', 'middleware' => 'isAjax']);
        Route::get('{layerId}/edit', ['uses' => 'Layer@edit', 'as' => 'layerQuestion.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{layerId}', ['uses' => 'Layer@update', 'as' => 'layerQuestion.update', 'middleware' => 'isAjax']);
        Route::delete('{layerId}', ['uses' => 'Layer@destroy', 'as' => 'layerQuestion.delete']);
        Route::get('l/{id}', ['uses' => 'Layer@layer', 'as' => 'layerQuestion.layer']);
    });

    Route::group(['prefix' => 'question'], function() {
        Route::get('/', ['uses' => 'Question@index', 'as' => 'question.index']);
        Route::post('bootgrid', ['uses' => 'Question@bootgrid', 'as' => 'question.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Question@create', 'as' => 'question.create']);
        Route::post('store', ['uses' => 'Question@store', 'as' => 'question.store', 'middleware' => 'isAjax']);
        Route::get('{questionId}/edit', ['uses' => 'Question@edit', 'as' => 'question.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{questionId}', ['uses' => 'Question@update', 'as' => 'question.update', 'middleware' => 'isAjax']);
        Route::delete('{questionId}', ['uses' => 'Question@destroy', 'as' => 'question.delete']);
    });

    Route::group(['prefix' => 'upload'], function() {
        Route::get('/', ['uses' => 'Upload@index', 'as' => 'upload.index']);
        Route::post('bootgrid', ['uses' => 'Upload@bootgrid', 'as' => 'upload.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Upload@create', 'as' => 'upload.create']);
        Route::put('store', ['uses' => 'Upload@store', 'as' => 'upload.store', 'middleware' => 'isAjax']);
        Route::get('{uploadId}/edit', ['uses' => 'Upload@edit', 'as' => 'upload.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{uploadId}', ['uses' => 'Upload@update', 'as' => 'upload.update', 'middleware' => 'isAjax']);
        Route::delete('{uploadId}', ['uses' => 'Upload@destroy', 'as' => 'upload.delete']);
        Route::get('upload', ['uses' => 'Upload@upload', 'as' => 'upload.upload']);
        Route::get('download', ['uses' => 'Upload@download', 'as' => 'upload.download']);
    });

    Route::group(['prefix' => 'activity'], function() {
        Route::get('/', ['uses' => 'Activity@index', 'as' => 'activity.index']);
        Route::post('bootgrid', ['uses' => 'Activity@bootgrid', 'as' => 'activity.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Activity@create', 'as' => 'activity.create']);
        Route::post('store', ['uses' => 'Activity@store', 'as' => 'activity.store', 'middleware' => 'isAjax']);
        Route::get('{activityId}/edit', ['uses' => 'Activity@edit', 'as' => 'activity.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{activityId}', ['uses' => 'Activity@update', 'as' => 'activity.update', 'middleware' => 'isAjax']);
        Route::delete('{activityId}', ['uses' => 'Activity@destroy', 'as' => 'activity.delete']);
    });

    Route::group(['prefix' => 'education'], function() {
        Route::get('/', ['uses' => 'Education@index', 'as' => 'education.index']);
        Route::post('bootgrid', ['uses' => 'Education@bootgrid', 'as' => 'education.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Education@create', 'as' => 'education.create']);
        Route::post('store', ['uses' => 'Education@store', 'as' => 'education.store', 'middleware' => 'isAjax']);
        Route::get('{educationId}/edit', ['uses' => 'Education@edit', 'as' => 'education.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{educationId}', ['uses' => 'Education@update', 'as' => 'education.update', 'middleware' => 'isAjax']);
        Route::delete('{educationId}', ['uses' => 'Education@destroy', 'as' => 'education.delete']);
    });

    Route::group(['prefix' => 'expense'], function() {
        Route::get('/', ['uses' => 'Expense@index', 'as' => 'expense.index']);
        Route::post('bootgrid', ['uses' => 'Expense@bootgrid', 'as' => 'expense.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Expense@create', 'as' => 'expense.create']);
        Route::post('store', ['uses' => 'Expense@store', 'as' => 'expense.store', 'middleware' => 'isAjax']);
        Route::get('{expenseId}/edit', ['uses' => 'Expense@edit', 'as' => 'expense.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{expenseId}', ['uses' => 'Expense@update', 'as' => 'expense.update', 'middleware' => 'isAjax']);
        Route::delete('{expenseId}', ['uses' => 'Expense@destroy', 'as' => 'expense.delete']);
    });

    Route::group(['prefix' => 'hobby'], function() {
        Route::get('/', ['uses' => 'Hobby@index', 'as' => 'hobby.index']);
        Route::post('bootgrid', ['uses' => 'Hobby@bootgrid', 'as' => 'hobby.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Hobby@create', 'as' => 'hobby.create']);
        Route::post('store', ['uses' => 'Hobby@store', 'as' => 'hobby.store', 'middleware' => 'isAjax']);
        Route::get('{hobbyId}/edit', ['uses' => 'Hobby@edit', 'as' => 'hobby.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{hobbyId}', ['uses' => 'Hobby@update', 'as' => 'hobby.update', 'middleware' => 'isAjax']);
        Route::delete('{hobbyId}', ['uses' => 'Hobby@destroy', 'as' => 'hobby.delete']);
    });

    Route::group(['prefix' => 'interest'], function() {
        Route::get('/', ['uses' => 'Interest@index', 'as' => 'interest.index']);
        Route::post('bootgrid', ['uses' => 'Interest@bootgrid', 'as' => 'interest.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Interest@create', 'as' => 'interest.create']);
        Route::post('store', ['uses' => 'Interest@store', 'as' => 'interest.store', 'middleware' => 'isAjax']);
        Route::get('{interestId}/edit', ['uses' => 'Interest@edit', 'as' => 'interest.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{interestId}', ['uses' => 'Interest@update', 'as' => 'interest.update', 'middleware' => 'isAjax']);
        Route::delete('{interestId}', ['uses' => 'Interest@destroy', 'as' => 'interest.delete']);
    });

    Route::group(['prefix' => 'media'], function() {
        Route::get('/', ['uses' => 'Media@index', 'as' => 'media.index']);
        Route::post('bootgrid', ['uses' => 'Media@bootgrid', 'as' => 'media.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Media@create', 'as' => 'media.create']);
        Route::post('store', ['uses' => 'Media@store', 'as' => 'media.store', 'middleware' => 'isAjax']);
        Route::get('{mediaId}/edit', ['uses' => 'Media@edit', 'as' => 'media.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{mediaId}', ['uses' => 'Media@update', 'as' => 'media.update', 'middleware' => 'isAjax']);
        Route::delete('{mediaId}', ['uses' => 'Media@destroy', 'as' => 'media.delete']);
    });

    Route::group(['prefix' => 'mediaGroup'], function() {
        Route::get('/', ['uses' => 'MediaGroup@index', 'as' => 'mediaGroup.index']);
        Route::post('bootgrid', ['uses' => 'MediaGroup@bootgrid', 'as' => 'mediaGroup.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'MediaGroup@create', 'as' => 'mediaGroup.create']);
        Route::post('store', ['uses' => 'MediaGroup@store', 'as' => 'mediaGroup.store', 'middleware' => 'isAjax']);
        Route::get('{mediaGroupId}/edit', ['uses' => 'MediaGroup@edit', 'as' => 'mediaGroup.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{mediaGroupId}', ['uses' => 'MediaGroup@update', 'as' => 'mediaGroup.update', 'middleware' => 'isAjax']);
        Route::delete('{mediaGroupId}', ['uses' => 'MediaGroup@destroy', 'as' => 'mediaGroup.delete']);
    });

    Route::group(['prefix' => 'profession'], function() {
        Route::get('/', ['uses' => 'Profession@index', 'as' => 'profession.index']);
        Route::post('bootgrid', ['uses' => 'Profession@bootgrid', 'as' => 'profession.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Profession@create', 'as' => 'profession.create']);
        Route::post('store', ['uses' => 'Profession@store', 'as' => 'profession.store', 'middleware' => 'isAjax']);
        Route::get('{professionId}/edit', ['uses' => 'Profession@edit', 'as' => 'profession.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{professionId}', ['uses' => 'Profession@update', 'as' => 'profession.update', 'middleware' => 'isAjax']);
        Route::delete('{professionId}', ['uses' => 'Profession@destroy', 'as' => 'profession.delete']);
    });

    Route::group(['prefix' => 'greaterArea'], function() {
        Route::get('/', ['uses' => 'GreaterArea@index', 'as' => 'greaterArea.index']);
    });

    Route::group(['prefix' => 'source'], function() {
        Route::get('/', ['uses' => 'Source@index', 'as' => 'source.index']);
        Route::post('bootgrid', ['uses' => 'Source@bootgrid', 'as' => 'source.bootgrid', 'middleware' => 'isAjax']);
        Route::get('create', ['uses' => 'Source@create', 'as' => 'source.create']);
        Route::post('store', ['uses' => 'Source@store', 'as' => 'source.store', 'middleware' => 'isAjax']);
        Route::get('{sourceId}/edit', ['uses' => 'Source@edit', 'as' => 'source.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{sourceId}', ['uses' => 'Source@update', 'as' => 'source.update', 'middleware' => 'isAjax']);
        Route::delete('{sourceId}', ['uses' => 'Source@destroy', 'as' => 'source.delete']);
    });

    Route::group(['prefix' => 'vehicle'], function() {
        Route::get('/', ['uses' => 'Vehicle@index', 'as' => 'vehicle.index']);
    });
});
