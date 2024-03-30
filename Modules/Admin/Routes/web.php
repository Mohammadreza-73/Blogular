<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', 'DashboardController@index')->name('panel');
