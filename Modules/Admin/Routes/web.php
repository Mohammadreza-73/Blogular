<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', 'DashboardController@index')->name('panel');

Route::get('/profile', 'ProfileController@show')->name('profile');
Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');
