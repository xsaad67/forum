<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
	use DatabaseMigrations;


	public function guests_may_not_create_threads(){

		$thread = create('App\Thread');

 		$this->post('/threads',$thread->toArray());
	}

	/** @test **/
 	public function an_authenticated_user_can_create_thread(){

 		$this->signIn();
 		$thread = make('App\Thread');
 		$response = $this->post('/threads',$thread->toArray());
 		$this->get($response->headers->get('Location'))
 			->assertSee($thread->title)
 			->assertSee($thread->body);

 	}

 	/** @test **/
 	public function a_thread_requires_a_title(){
 		$this->publishThread(['title'=>null])
 			->assertSessionHasErrors('title');
 	}

 	/** @test **/
 	public function a_thread_requires_a_body(){
 		$this->publishThread(['body'=>null])
 			->assertSessionHasErrors('body');
 	}

 	/** @test **/
 	public function a_thread_requires_a_channel(){
 		factory('App\Channel',2)->create();

 		$this->publishThread(['channel_id'=>null])
 			->assertSessionHasErrors('channel_id');

 		$this->publishThread(['channel_id'=>9999])
 			->assertSessionHasErrors('channel_id');
 	}

 	public function publishThread($overrides=[]){

 		$this->signIn();

 		$thread = make('App\Thread',$overrides);

 		return $this->post('/threads',$thread->toArray());
 	}


}

