<?php

namespace Matthv\Skeletor\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainController extends BaseController {

	/**
	 * @return Factory|View
	 */
    public function index() {
		if (Auth::guard(config('skeletor.middleware_auth'))->check()) {
			return redirect(route('skeletor.admin.dashboard'));
		}
		return redirect(route('skeletor.auth.login'));
    }

	/**
	 * @return Factory|View
	 */
	public function dashboard() {
		return view('skeletor::admin.index');
	}
}
