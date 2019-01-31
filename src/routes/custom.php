<?php

Route::namespace('App\Http\Controllers')
		->prefix(config('skeletor.route_prefix'))
		->name(config('skeletor.route_prefix') . '.')
		->middleware(config('skeletor.middleware_auth'))
		->group(function(){
			// YOUR CUSTOM ROUTES
});