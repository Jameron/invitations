<?php namespace Jameron\Invitations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jameron\Invitations\Models\Traits\Invitable;

class Invitation extends Model {

    use Invitable;

    protected $table = 'invitations';

	public function roles()
	{
		return $this->belongsToMany('Jameron\Regulator\Models\Role', 'invitations_role_user');
	}

  	public function invitable()
    {
    	return $this->morphTo();
    }
}
