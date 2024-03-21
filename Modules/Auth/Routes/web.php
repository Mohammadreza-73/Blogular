<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', 'RegisterController@view')->name('register');
    Route::post('/register', 'RegisterController@register')->name('regsiter');

    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');

    Route::get('/forgot-password', 'ForgotPasswordController@index')->name('forgot-password');
});

Route::get('/logout', 'LogoutController')->middleware('auth')->name('logout');
