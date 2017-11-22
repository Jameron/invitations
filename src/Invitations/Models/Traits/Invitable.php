<?php namespace Jameron\Invitations\Models\Traits;

trait InvitableTrait {

	/**
	 * Returns a collection of TermRelation model objects. These models create 
     * relationships between a taggable model and vocabulary/term model object.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function invitations() 
	{
        return $this->morphMany('Jameron\Models\Invitation', 'invitable');
    }	

	/**
	 * Returns a TermRelation model objects.
	 *
	 * @param  integer $term_id
	 * @return Snap\Taxonomy\Models\TermRelation
	 */
	public function relate($model_id)
	{
		return $this->addModel($model_id);
	}

	/**
	 * Inserts and then returns a new TermRelation model objects.
	 *
	 * @param  integer|object $term_id
	 * @return Snap\Taxonomy\Models\TermRelation
	 */
	public function addModel($related_model) 
	{

        return $this->invitations()->save($related_model);
	}

	/**
	 * Returns a collection of TermRelation model objects.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getAllInvitations() 
	{
		return $this->invitations()->get();
	}

}
