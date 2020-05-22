<?php

namespace Matthv\Skeletor\Forms;

use Illuminate\Validation\Rules\Unique;
use Kris\LaravelFormBuilder\Form;

class AccountForm extends Form
{
    public function buildForm() {
		$uniqueClosure = function() {
			return (new Unique('admins', 'email'))->ignore($this->model['id'], 'id');
		};

        $this
            ->add('name', 'text', [
				'label'	=>	__('validation.attributes.name'),
				'rules'	=>	'required|max:100'
			])
			->add('email', 'text', [
					'label'	=>	__('validation.attributes.email'),
				'rules' 	=> [
					'required',
					'email',
					'max:50',
					$uniqueClosure
				],
			])
			->add('password', 'password', [
				'label'			=>	__('validation.attributes.password'),
				'rules'			=>	'nullable|min:5',
				'help_block' 	=> 	[
                    'text' 	=>  __('skeletor::skeletor.messages.account_password_helper'),
                    'tag'	=>	'em',
				],
				'value'			=> 	''
			])
		;

		$this->formOptions = [
			'method' 	=> 'POST',
			'url' 		=> route(config('skeletor.route_prefix') . '.account')
		];
    }
}
