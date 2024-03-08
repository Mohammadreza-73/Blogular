<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@index')->name('login');