<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function tour(){
    	return $this->belongsTo('Tour', 'tour_id');
    }

    public function user(){
    	return $this->belongsTo('User', 'user_id');
    }
}
