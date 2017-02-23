<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promotions extends Model
{
	protected $table = 'promotions';

    public function author(){
    	return $this->belongsTo('App\User', 'author_id');
    }

    public function getDateAttribute(){
        if($this->created_at == null){
            return null;
        }
		if($this->created_at->diffInDays(Carbon::now()) == 0)
    		return $this->created_at->diffForHumans();
    	else
    		return $this->created_at->format('j F Y\\, h:i A');	
		
    }
}
