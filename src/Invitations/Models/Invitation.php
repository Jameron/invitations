<?php namespace Jameron\Invitations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model {


    protected $table = 'invitations';
    protected $dates = ['expires_at'];

	public function roles()
	{
		return $this->belongsToMany('Jameron\Regulator\Models\Role', 'invitations_role_user');
	}

  	public function invitable()
    {
    	return $this->morphTo();
    }

    public function getRelatedAttribute()
    {
        return $this->invitable->{config('invitations.related.value_column')};
    }
}
