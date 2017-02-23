<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';

    public function tour(){
    	return $this->belongsTo('Tour', 'tour_id');
    }
}
