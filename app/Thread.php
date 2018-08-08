<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    
    public function replies(){
    	return $this->hasMany(Reply::class);
    }

    public function creater(){
    	return $this->belongsTo(User::class,'user_id');
    }

    public function channel(){
    	return $this->belongsTo(Channel::class);
    }


    public function path(){
    	return '/thread/'.$this->channel->slug.'/'.$this->id;
    }
}
