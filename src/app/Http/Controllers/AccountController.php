<?php

namespace Matthv\Skeletor\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Matthv\Skeletor\App\Forms\AccountForm;
use Matthv\Skeletor\App\Models\Admin;

class AccountController extends CRUDController
{
	protected $model = Admin::class;

	protected $icon = 'fas fa-user';

	protected $form = AccountForm::class;

    public function profile(Request $request) {
		$admin = Auth::guard('admin')->user();
		$form = $this->getForm($admin);
		$buttons = $this->buttons;

        if ($request->isMethod('post')) {
            $form->redirectIfNotValid();
            $formRequest = $form->getFieldValues();
            if (array_key_exists('password', $formRequest)) {
                $formRequest['password'] = Hash::make($formRequest['password']);
            }
            $admin->update($formRequest);
            return redirect()->route('admin.account')->with('success',  __('skeletor::skeletor.messages.account_updated'));
        }
		$model = $form->getModel();
		return view('skeletor::admin.account.index', compact('form', 'buttons', 'model'));
    }

	/**
	 * @param null $admin
	 * @return AccountForm
	 */
	public function getForm($admin = null): AccountForm {
		return $this->formBuilder->create(AccountForm::class, [
			'model' => $admin
		]);
	}

    /**
     *
     * @return array
     */
    public function setButtons(): array {
        return $this->buttons = [
            'save_and_edit'	=>	[
                'icons' => 	['fa-save'],
                'label'	=>	 __('skeletor::skeletor.buttons.save'),
            ],
        ];
    }

}
