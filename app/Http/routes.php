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
Route::group(['middleware' => 'auth'], function() {

    Route::get('/', ['uses' => 'Dashboard@index', 'as' => 'dashboard']);
    Route::get('dashboard/', ['uses' => 'Dashboard@index', 'as' => 'dashboard']);

    Route::group(['namespace' => 'Audiences', 'prefix' => 'audiences'], function() {

        Route::group(['prefix' => 'layerQuestion'], function() {
            Route::get('/', ['uses' => 'Layer@index', 'as' => 'layerQuestion.index']);
            Route::post('bootgrid', ['uses' => 'Layer@bootgrid', 'as' => 'layerQuestion.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Layer@create', 'as' => 'layerQuestion.create']);
            Route::post('store', ['uses' => 'Layer@store', 'as' => 'layerQuestion.store', 'middleware' => 'IsAjax']);
            Route::get('{layerId}/edit', ['uses' => 'Layer@edit', 'as' => 'layerQuestion.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{layerId}', ['uses' => 'Layer@update', 'as' => 'layerQuestion.update', 'middleware' => 'IsAjax']);
            Route::delete('{layerId}', ['uses' => 'Layer@destroy', 'as' => 'layerQuestion.delete']);
            Route::get('l/{id}', ['uses' => 'Layer@layer', 'as' => 'layerQuestion.layer']);
        });

        Route::group(['prefix' => 'question'], function() {
            Route::get('/', ['uses' => 'Question@index', 'as' => 'question.index']);
            Route::post('bootgrid', ['uses' => 'Question@bootgrid', 'as' => 'question.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Question@create', 'as' => 'question.create']);
            Route::post('store', ['uses' => 'Question@store', 'as' => 'question.store', 'middleware' => 'IsAjax']);
            Route::get('{questionId}/edit', ['uses' => 'Question@edit', 'as' => 'question.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{questionId}', ['uses' => 'Question@update', 'as' => 'question.update', 'middleware' => 'IsAjax']);
            Route::delete('{questionId}', ['uses' => 'Question@destroy', 'as' => 'question.delete']);
        });

        Route::group(['prefix' => 'audience'], function() {
            Route::get('/', ['uses' => 'Audience@index', 'as' => 'audience.index']);
            Route::post('bootgrid', ['uses' => 'Audience@bootgrid', 'as' => 'audience.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Audience@create', 'as' => 'audience.create']);
            Route::post('store', ['uses' => 'Audience@store', 'as' => 'audience.store', 'middleware' => 'IsAjax']);
            Route::get('{audienceId}/edit', ['uses' => 'Audience@edit', 'as' => 'audience.edit']);
            Route::get('{audienceId}', ['uses' => 'Audience@show', 'as' => 'audience.show', 'middleware' => 'IsAjax']);
            Route::match(['PUT', 'PATCH'], 'update/{audienceId}', ['uses' => 'Audience@update', 'as' => 'audience.update', 'middleware' => 'IsAjax']);
            Route::delete('{audienceId}', ['uses' => 'Audience@destroy', 'as' => 'audience.delete']);
            Route::post('validate', ['uses' => 'Audience@validateAudienceLayer', 'as' => 'audience.validate', 'middleware' => 'IsAjax']);
        });
    });

    Route::group(['namespace' => 'Masters', 'prefix' => 'masters'], function() {

        Route::group(['prefix' => 'activity'], function() {
            Route::get('/', ['uses' => 'Activity@index', 'as' => 'activity.index']);
            Route::post('bootgrid', ['uses' => 'Activity@bootgrid', 'as' => 'activity.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Activity@create', 'as' => 'activity.create']);
            Route::post('store', ['uses' => 'Activity@store', 'as' => 'activity.store', 'middleware' => 'IsAjax']);
            Route::get('{activityId}/edit', ['uses' => 'Activity@edit', 'as' => 'activity.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{activityId}', ['uses' => 'Activity@update', 'as' => 'activity.update', 'middleware' => 'IsAjax']);
            Route::delete('{activityId}', ['uses' => 'Activity@destroy', 'as' => 'activity.delete']);
            Route::post('lists', ['uses' => 'Activity@lists', 'as' => 'activity.lists']);
        });

        Route::group(['prefix' => 'education'], function() {
            Route::get('/', ['uses' => 'Education@index', 'as' => 'education.index']);
            Route::post('bootgrid', ['uses' => 'Education@bootgrid', 'as' => 'education.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Education@create', 'as' => 'education.create']);
            Route::post('store', ['uses' => 'Education@store', 'as' => 'education.store', 'middleware' => 'IsAjax']);
            Route::get('{educationId}/edit', ['uses' => 'Education@edit', 'as' => 'education.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{educationId}', ['uses' => 'Education@update', 'as' => 'education.update', 'middleware' => 'IsAjax']);
            Route::delete('{educationId}', ['uses' => 'Education@destroy', 'as' => 'education.delete']);
        });

        Route::group(['prefix' => 'expense'], function() {
            Route::get('/', ['uses' => 'Expense@index', 'as' => 'expense.index']);
            Route::post('bootgrid', ['uses' => 'Expense@bootgrid', 'as' => 'expense.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Expense@create', 'as' => 'expense.create']);
            Route::post('store', ['uses' => 'Expense@store', 'as' => 'expense.store', 'middleware' => 'IsAjax']);
            Route::get('{expenseId}/edit', ['uses' => 'Expense@edit', 'as' => 'expense.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{expenseId}', ['uses' => 'Expense@update', 'as' => 'expense.update', 'middleware' => 'IsAjax']);
            Route::delete('{expenseId}', ['uses' => 'Expense@destroy', 'as' => 'expense.delete']);
        });

        Route::group(['prefix' => 'hobby'], function() {
            Route::get('/', ['uses' => 'Hobby@index', 'as' => 'hobby.index']);
            Route::post('bootgrid', ['uses' => 'Hobby@bootgrid', 'as' => 'hobby.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Hobby@create', 'as' => 'hobby.create']);
            Route::post('store', ['uses' => 'Hobby@store', 'as' => 'hobby.store', 'middleware' => 'IsAjax']);
            Route::get('{hobbyId}/edit', ['uses' => 'Hobby@edit', 'as' => 'hobby.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{hobbyId}', ['uses' => 'Hobby@update', 'as' => 'hobby.update', 'middleware' => 'IsAjax']);
            Route::delete('{hobbyId}', ['uses' => 'Hobby@destroy', 'as' => 'hobby.delete']);
        });

        Route::group(['prefix' => 'interest'], function() {
            Route::get('/', ['uses' => 'Interest@index', 'as' => 'interest.index']);
            Route::post('bootgrid', ['uses' => 'Interest@bootgrid', 'as' => 'interest.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Interest@create', 'as' => 'interest.create']);
            Route::post('store', ['uses' => 'Interest@store', 'as' => 'interest.store', 'middleware' => 'IsAjax']);
            Route::get('{interestId}/edit', ['uses' => 'Interest@edit', 'as' => 'interest.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{interestId}', ['uses' => 'Interest@update', 'as' => 'interest.update', 'middleware' => 'IsAjax']);
            Route::delete('{interestId}', ['uses' => 'Interest@destroy', 'as' => 'interest.delete']);
        });

        Route::group(['prefix' => 'profession'], function() {
            Route::get('/', ['uses' => 'Profession@index', 'as' => 'profession.index']);
            Route::post('bootgrid', ['uses' => 'Profession@bootgrid', 'as' => 'profession.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Profession@create', 'as' => 'profession.create']);
            Route::post('store', ['uses' => 'Profession@store', 'as' => 'profession.store', 'middleware' => 'IsAjax']);
            Route::get('{professionId}/edit', ['uses' => 'Profession@edit', 'as' => 'profession.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{professionId}', ['uses' => 'Profession@update', 'as' => 'profession.update', 'middleware' => 'IsAjax']);
            Route::delete('{professionId}', ['uses' => 'Profession@destroy', 'as' => 'profession.delete']);
        });

        Route::group(['prefix' => 'greaterArea'], function() {
            Route::get('/', ['uses' => 'GreaterArea@index', 'as' => 'greaterArea.index']);
            Route::get('create', ['uses' => 'GreaterArea@create', 'as' => 'greaterArea.create']);
            Route::get('{greaterAreaId}/edit', ['uses' => 'GreaterArea@edit', 'as' => 'greaterArea.edit']);
        });

        Route::group(['prefix' => 'source'], function() {
            Route::get('/', ['uses' => 'Source@index', 'as' => 'source.index']);
            Route::post('bootgrid', ['uses' => 'Source@bootgrid', 'as' => 'source.bootgrid', 'middleware' => 'IsAjax']);
            Route::get('create', ['uses' => 'Source@create', 'as' => 'source.create']);
            Route::post('store', ['uses' => 'Source@store', 'as' => 'source.store', 'middleware' => 'IsAjax']);
            Route::get('{sourceId}/edit', ['uses' => 'Source@edit', 'as' => 'source.edit']);
            Route::match(['PUT', 'PATCH'], 'update/{sourceId}', ['uses' => 'Source@update', 'as' => 'source.update', 'middleware' => 'IsAjax']);
            Route::delete('{sourceId}', ['uses' => 'Source@destroy', 'as' => 'source.delete']);
        });
    });

    Route::group(['prefix' => 'upload'], function() {
        Route::get('/', ['uses' => 'Upload@index', 'as' => 'upload.index']);
        Route::post('bootgrid', ['uses' => 'Upload@bootgrid', 'as' => 'upload.bootgrid', 'middleware' => 'IsAjax']);
        Route::get('create', ['uses' => 'Upload@create', 'as' => 'upload.create']);
        Route::put('store', ['uses' => 'Upload@store', 'as' => 'upload.store', 'middleware' => 'IsAjax']);
        Route::get('{uploadId}/edit', ['uses' => 'Upload@edit', 'as' => 'upload.edit']);
        Route::match(['PUT', 'PATCH'], 'update/{uploadId}', ['uses' => 'Upload@update', 'as' => 'upload.update', 'middleware' => 'IsAjax']);
        Route::delete('{uploadId}', ['uses' => 'Upload@destroy', 'as' => 'upload.delete']);
        Route::get('upload', ['uses' => 'Upload@upload', 'as' => 'upload.upload']);
        Route::get('download', ['uses' => 'Upload@download', 'as' => 'upload.download']);
    });

    Route::group(['namespace' => 'Vehicles', 'prefix' => 'vehicles'], function() {

        Route::group(['prefix' => 'classification'], function() {
            Route::get('/', ['uses' => 'Classification@index', 'as' => 'classification.index']);
            Route::get('create', ['uses' => 'Classification@create', 'as' => 'classification.create']);
            Route::get('{classificationId}/edit', ['uses' => 'Classification@edit', 'as' => 'classification.edit']);
        });

        Route::group(['prefix' => 'brand'], function() {
            Route::get('/', ['uses' => 'Brand@index', 'as' => 'brand.index']);
            Route::get('create', ['uses' => 'Brand@create', 'as' => 'brand.create']);
            Route::get('{brandId}/edit', ['uses' => 'Brand@edit', 'as' => 'brand.edit']);
        });

        Route::group(['prefix' => 'series'], function() {
            Route::get('/', ['uses' => 'Series@index', 'as' => 'series.index']);
            Route::get('create', ['uses' => 'Series@create', 'as' => 'series.create']);
            Route::get('{seriesId}/edit', ['uses' => 'Series@edit', 'as' => 'series.edit']);
        });

        Route::group(['prefix' => 'type'], function() {
            Route::get('/', ['uses' => 'Type@index', 'as' => 'type.index']);
            Route::get('create', ['uses' => 'Type@create', 'as' => 'type.create']);
            Route::get('{typeId}/edit', ['uses' => 'Type@edit', 'as' => 'type.edit']);
        });
    });
});
