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

// Android - NIE puszczać na produkcje bez zrobionej autentykacji
Route::get("api/budgets/{type_id?}", ["uses" => "BudgetController@getJSON"]);
Route::get("api/budget/{id}", ["uses" => "BudgetController@findObject"]);
Route::post("api/budget/add", ["uses" => "BudgetController@apiStore"]);
Route::post("api/budget/edit/{id}", ["uses" => "BudgetController@apiStore"])->where(["id" => "[0-9]+"]);
Route::post("api/budget/delete/{id}", ["uses" => "BudgetController@apiDelete"])->where(["id" => "[0-9]+"]);

Route::get("api/sources/{type_id?}", ["uses" => "SourceController@getJSON"]);
Route::get("api/source/{id}", ["uses" => "SourceController@findObject"]);
Route::post("api/source/add", ["uses" => "SourceController@apiStore"]);
Route::post("api/source/edit/{id}", ["uses" => "SourceController@apiStore"])->where(["id" => "[0-9]+"]);
Route::post("api/source/delete/{id}", ["uses" => "SourceController@apiDelete"])->where(["id" => "[0-9]+"]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
