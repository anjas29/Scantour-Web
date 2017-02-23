<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function news(){
        return $this->hasMany('News', 'author_id');
    }

    public function promotions(){
        return $this->hasMany('Promotions', 'author_id');
    }

    public function tour(){
        return $this->hasOne('Tour', 'owner_id');
    }

    public function comments(){
        return $this->hasMany('Comment', 'user_id');
    }

    public function isAdmin(){
        if($this->role == 'Administrator'){
            return true;
        }

        return false;
    }

    public function isVisitor(){
        if($this->role == 'Visitor'){
            return true;
        }

        return false;
    }

    /*public function roles(){
        return $this->belongsToMany('App\Roles');
    }

    public function assignRole($role){
        if(is_string($role)){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->attach($role);
    }

    public function revokeRole($role){
        if(is_string($role)){
            $role = Role::where('name', $role)->first();
        }

        return $this->roles()->detach($role);
    }

    public function hasRole($name){
        foreach ($this->roles as $role) {
            if($role->name === $name) return true;
        }

        return false;
    }

    */

}
