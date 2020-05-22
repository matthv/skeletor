<?php

Route::group([
	'namespace'  => 'Matthv\Skeletor\Http\Controllers',
	'middleware' => 'web',
	'prefix'     => config('skeletor.route_prefix'),
],
function () {
	Route::get('/', 'MainController@index')->name('skeletor.admin');
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('skeletor.auth.login');
	Route::post('login', 'Auth\LoginController@login');
	Route::get('logout', 'Auth\LoginController@logout')->name('skeletor.auth.logout');
	Route::post('logout', 'Auth\LoginController@logout');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('skeletor.auth.password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('skeletor.auth.password.reset.token');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('skeletor.auth.password.email');
	Route::get('/dashboard', 'MainController@dashboard')->name('skeletor.admin.dashboard')->middleware(config('skeletor.middleware_auth'));
});

Route::namespace('Matthv\Skeletor\Http\Controllers')
		->prefix(config('skeletor.route_prefix'))
		->name(config('skeletor.route_prefix') . '.')
		->middleware('web', config('skeletor.middleware_auth'))
		->group(function(){
			Route::match(['get', 'post'], 'account', 'AccountController@profile')->name('account');
});
