<?php

use Matthv\Skeletor\Http\Controllers\AccountController;
use Matthv\Skeletor\Http\Controllers\Auth\ForgotPasswordController;
use Matthv\Skeletor\Http\Controllers\Auth\LoginController;
use Matthv\Skeletor\Http\Controllers\Auth\ResetPasswordController;
use Matthv\Skeletor\Http\Controllers\MainController;

Route::group([
	'namespace'  => 'Matthv\Skeletor\Http\Controllers',
	'middleware' => 'web',
	'prefix'     => config('skeletor.route_prefix'),
],
function () {
	Route::get('/', [MainController::class, 'index'])->name('skeletor.admin');
	Route::get('login', [LoginController::class, 'showLoginForm'])->name('skeletor.auth.login');
	Route::post('login', [LoginController::class, 'login']);
	Route::get('logout', [LoginController::class, 'logout'])->name('skeletor.auth.logout');
	Route::post('logout', [LoginController::class, 'logout']);
	Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('skeletor.auth.password.reset');
	Route::post('password/reset', [ResetPasswordController::class, 'reset']);
	Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('skeletor.auth.password.reset.token');
	Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('skeletor.auth.password.email');
	Route::get('/dashboard', [MainController::class, 'dashboard'])->name('skeletor.admin.dashboard')->middleware(config('skeletor.middleware_auth'));
});

Route::namespace('Matthv\Skeletor\Http\Controllers')
		->prefix(config('skeletor.route_prefix'))
		->name(config('skeletor.route_prefix') . '.')
		->middleware('web', config('skeletor.middleware_auth'))
		->group(function(){
			Route::match(['get', 'post'], 'account', [AccountController::class, 'profile'])->name('account');
});
