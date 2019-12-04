<?php

use Carbon\Carbon;

Route::get('/', 'RateController@index');

Route::get('3', function (){
//    \Illuminate\Support\Facades\Artisan::call('currency:read --date=2019-03-09');
    \Illuminate\Support\Facades\Artisan::call('currency:read --date=');
});
