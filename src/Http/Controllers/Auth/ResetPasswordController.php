<?php

namespace Matthv\Skeletor\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('skeletor.admin');
        $this->middleware('guest');
    }

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param Request      $request
	 * @param  string|null $token
	 *
	 * @return Factory|View
	 */
	public function showResetForm(Request $request, $token = null)
	{
		return view('skeletor::auth.passwords.reset')->with(
				['token' => $token, 'email' => $request->email]
		);
	}


	/**
	 * Get the broker to be used during password reset.
	 *
	 * @return PasswordBroker
	 */
	public function broker()
	{
		return Password::broker('admins');
	}

	/**
	 * Get the guard to be used during password reset.
	 *
	 * @return StatefulGuard
	 */
	protected function guard()
	{
		return Auth::guard('admin');
	}

}
