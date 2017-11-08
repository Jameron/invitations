<?php namespace Jameron\Invitations\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model {

    protected $table = 'invitations';

	public function roles()
	{
		return $this->belongsToMany('Jameron\Regulator\Models\Role', 'invitations_role_user');
	}
}
