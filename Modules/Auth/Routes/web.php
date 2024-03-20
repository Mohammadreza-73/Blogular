<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@index')->name('login');

Route::get('/forgot-password', 'ForgotPasswordController@index')->name('forgot-password');

Route::get('/register', 'RegisterController@view')->name('register');

Route::post('/register', 'RegisterController@register')->name('');