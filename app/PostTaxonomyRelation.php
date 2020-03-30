<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTaxonomyRelation extends Model
{
    public $table = "post_taxonomy_relation";

    protected $fillable = [
        'id','tax_id','post_id'
    ];
}
