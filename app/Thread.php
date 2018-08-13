<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $with = ['creater','channel'];
    
    protected static function boot(){
        parent::boot();

        static::addGlobalScope('replyCount',function($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread){
            $thread->replies()->delete();
        });

    }
    
   
    public function replies(){
    	return $this->hasMany(Reply::class);
                    // ->withCount('favorites')
                    // ->with('owner');
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

    public function scopeFilter($query,$filters){
        $filters->apply($query);
    }

    // public function getReplyCountAttribute(){
    //     return $this->reply()->count();
    // }
    
}
