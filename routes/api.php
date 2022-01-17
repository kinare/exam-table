<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your exam. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function (){

    Route::apiResource('/exams', 'ExamController');
    Route::post('/exams/{id}/submit', 'ExamController@submit');
    Route::apiResource('/questions', 'QuestionController');
    Route::apiResource('/options', 'OptionController');
    Route::apiResource('/categories', 'CategoryController');

});

