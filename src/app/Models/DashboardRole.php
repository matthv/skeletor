<?php

namespace Matthv\Skeletor\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DashboardRole extends Model
{
	protected $fillable = [
		'name'
	];

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}

	/**
	 * @return BelongsToMany
	 */
	public function admins(): BelongsToMany {
		return $this->belongsToMany(Admin::class)->withTimestamps();
	}
}
