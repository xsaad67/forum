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

    	$this->signIn();//authenticated user

    	$thread = create('App\Thread');

    	$reply = create('App\Reply');

    	$this->post($thread->path().'/reply',$reply->toArray());

    	$this->get($thread->path())->assertSee($reply->body);
    }
}
