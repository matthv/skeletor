<?php

namespace Matthv\Skeletor\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class MainController extends BaseController {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index() {
		if (Auth::guard(config('skeletor.middleware_auth'))->check()) {
			return redirect(route('skeletor.admin.dashboard'));
		}
		return redirect(route('skeletor.auth.login'));
    }

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function dashboard() {
		return view('skeletor::admin.index');
	}
}
