<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}	

	public function post_taxonomy_relation()
    {
        return $this->hasMany('App\PostTaxonomyRelation','post_id');
    }

    public function post_taxonomy()
    {
    	return $this->belongsToMany('App\Post_taxonomy', 'post_taxonomy_relation', 'post_id', 'tax_id');
    }
	
}
