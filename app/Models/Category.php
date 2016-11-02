<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

    use SoftDeletes;

    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function tags(){
        $this->belongsToMany('App\Models\Tag')->withPivot('root, deleted_at')->withTimestamps();
    }
}
