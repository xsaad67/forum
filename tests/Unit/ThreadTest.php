<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{

	use DatabaseMigrations;

	/** @test **/
    public function a_thread_has_replies()
    {
        $thread = factory('App\Thread')->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$thread->replies);
    }

    /** @test **/
    public function a_thread_has_creater(){
    	$thread = factory('App\Thread')->create();
    	$this->assertInstanceOf('App\User',$thread->creater);
    }

    public function thread_belongs_to_channel(){
        $thread = create('App\Thread');
        $this->assertInstanceOf('App\Channel',$thread->channel);
    }
}
