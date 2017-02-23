<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'role';

    public $timestamps = false;

    protected $fillable = array('name');

    public function users(){
    	return $this->belongsToMany('App\User');
    }
}
