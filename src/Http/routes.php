<?php

Route::group(['prefix' => 'owmapi', 'namespace' => 'Gmopx\LaravelOWM\Http\Controllers'], function() {

    Route::get('current-weather', ['uses' => 'LaravelOWMController@currentweather']);
    Route::get('forecast', ['uses' => 'LaravelOWMController@forecast']);

});
