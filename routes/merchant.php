<?php

Route::group(['namespace' => 'Merchant'], function() {
    Route::get('/', 'HomeController@index')->name('merchant.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('merchant.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('merchant.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('merchant.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('merchant.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('merchant.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('merchant.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('merchant.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('merchant.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('merchant.verification.verify');

});