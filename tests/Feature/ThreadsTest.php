<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp(){
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_browse_threads()
    {
 
        $response = $this->get('/threads');
 
        $response->assertSee($this->thread->title);
    }

    /** @test **/

    public function a_user_browse_single_thread(){

        $response = $this->get('/thread/'.$this->thread->id);

        $response->assertSee($this->thread->title);

    }


    /** @test **/
    public function a_user_can_read_replies_that_are_associated_with_thread(){

        //Thread have replies
        $reply = factory('App\Reply')->create(['thread_id'=>$this->thread->id]); 
        //When we visit thread page
        $response = $this->get('/thread/'.$this->thread->id)
                    ->assertSee($reply->body);
    }
}
