<?php

namespace Matthv\Skeletor\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Matthv\Skeletor\Notifications\ResetPassword;

class Admin extends Authenticatable
{
    use Notifiable;

	const ACTIVE_DEFAULT = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'email',
		'password',
		'active',
    ];

	protected $casts = [
		'active'	=>  'boolean',
	];

	/**
	 * @return string
	 */
	public function	__toString() {
		return $this->name;
	}

	protected $attributes = [
		'active'	=>	self::ACTIVE_DEFAULT,
	];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPassword($token));
	}
}
