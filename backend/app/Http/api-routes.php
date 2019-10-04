<?php
Route::group(['prefix' => 'api/v1/orders', 'middleware' => 'cors'], function () {
    Route::get('/', 'OrderController@index');
    Route::group(['prefix' => 'customers'], function () {
        Route::get('{code}', 'OrderController@customerDetail');
        Route::get('/', 'OrderController@customers');
    });

    Route::group(['prefix' => 'films'], function () {
        Route::get('{code}', 'OrderController@filmDetail');
        Route::get('/', 'OrderController@films');
    });

    Route::post('create', 'OrderController@store');
    Route::get('{code}', 'OrderController@show');
    Route::delete('/', 'OrderController@delete');
    Route::put('{code}/update', 'OrderController@update');
});