<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::group(["middleware" => "auth"], function () {
    Route::get("/", ["as" => "budget.index", "uses" => "BudgetController@index"]);
    Route::get("budget/{type_id?}", ["as" => "budget.list", "uses" => "BudgetController@index"])->where(["type_id" => "[0-9]+"]);

    Route::get("budget/add", ["as" => "budget.addform", "uses" => "BudgetController@showAddEditForm"]);
    Route::post("budget/add", ["as" => "budget.postadd", "uses" => "BudgetController@store"]);
    Route::get("budget/edit/{id}", ["as" => "budget.editform", "uses" => "BudgetController@showAddEditForm"])->where(["id" => "[0-9]+"]);
    Route::post("budget/edit/{id}", ["as" => "budget.postedit", "uses" => "BudgetController@store"])->where(["id" => "[0-9]+"]);
    Route::delete("budget/delete/{id}", ["as" => "budget.delete", "uses" => "BudgetController@delete"])->where(["id" => "[0-9]+"]);

    Route::get("source/{type_id?}", ["as" => "source.index", "uses" => "SourceController@index"])->where(["type_id" => "[0-9]+"]);
    Route::get("source/json/{id}", ["as" => "source.json", "uses" => "SourceController@getJSONSourceData"])->where(["id" => "[0-9]+"]);
    Route::get("source/add", ["as" => "source.addform", "uses" => "SourceController@showAddEditForm"]);
    Route::post("source/add", ["as" => "source.postadd", "uses" => "SourceController@store"]);
    Route::get("source/edit/{id}", ["as" => "source.editform", "uses" => "SourceController@showAddEditForm"])->where(["id" => "[0-9]+"]);
    Route::post("source/edit/{id}", ["as" => "source.postedit", "uses" => "SourceController@store"])->where(["id" => "[0-9]+"]);
    Route::delete("source/delete/{id}", ["as" => "source.delete", "uses" => "SourceController@delete"])->where(["id" => "[0-9]+"]);

    Route::get("stats", ["as" => "stats.index", "uses" => "StatsController@index"]);
    Route::get("stats/json", ["as" => "stats.json", "uses" => "StatsController@getJSONStatsData"]);
});

Route::get("lang/{language}", ["as" => "lang.set", "uses" => "Controller@changeLanguage"]);

// Android - NIE puszczać na produkcje bez zrobionej autentykacji
// TODO: Nie przenieść do routes/api.php?
// Route::get("api/budgets/{type_id?}", ["uses" => "BudgetController@getJSON"]);
// Route::get("api/budget/{id}", ["uses" => "BudgetController@findObject"]);
// Route::post("api/budget/add", ["uses" => "BudgetController@apiStore"]);
// Route::post("api/budget/edit/{id}", ["uses" => "BudgetController@apiStore"])->where(["id" => "[0-9]+"]);
// Route::post("api/budget/delete/{id}", ["uses" => "BudgetController@apiDelete"])->where(["id" => "[0-9]+"]);
