<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';

    public function owner(){
    	return $this->belongsTo('App\User', 'owner_id');
    }

    public function comments(){
    	return $this->hasMany('App\Comment', 'tour_id');
    }

    public function rates(){
    	return $this->hasMany('App\Rates', 'tour_id');
    }
}
