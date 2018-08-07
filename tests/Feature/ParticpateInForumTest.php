<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticpateInForumTest extends TestCase
{
  
  	use DatabaseMigrations;

  	/** @test **/
    public function an_authenticated_user_may_participate_in_forum(){

    	$this->be($user = factory('App\User')->create()); //authenticated user

    	$thread = factory('App\Thread')->create();

    	$reply = factory('App\Reply')->create();

    	$this->post('/thread/'.$thread->id.'/reply',$reply->toArray());

    	$this->get('/thread/'.$thread->id)->assertSee($reply->body)
    }
}
