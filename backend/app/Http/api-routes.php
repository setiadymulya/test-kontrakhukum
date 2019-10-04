<?php
Route::group(['prefix' => 'api/v1/orders'], function () {
    Route::get('/', 'OrderController@index');
    Route::get('customers/{code}', 'OrderController@customerDetail');
    Route::get('customers', 'OrderController@customers');
    Route::get('films', 'OrderController@films');
    Route::get('films/{code}', 'OrderController@filmDetail');
    Route::post('create', 'OrderController@store');
    Route::get('{code}', 'OrderController@show');
    Route::delete('/', 'OrderController@delete');
    Route::put('{code}/update', 'OrderController@update');
});