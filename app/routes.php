<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'SnippetController@show');
Route::post('/', 'SnippetController@show');

Route::group(array('prefix' => 'admin'), function()
{
 
    Route::get('create',  'SnippetController@create');

    Route::get('edit/{id?}',  'SnippetController@edit');
    Route::post('edit', 'SnippetController@store');

    Route::get('destroy/{id?}',  'SnippetController@destroy');
    Route::post('destroy/{id?}', 'SnippetController@destroy');

});