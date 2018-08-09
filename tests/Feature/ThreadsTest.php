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

        $response = $this->get($this->thread->path());

        $response->assertSee($this->thread->title);

    }


    /** @test **/
    public function a_user_can_read_replies_that_are_associated_with_thread(){

        //Thread have replies
        $reply = factory('App\Reply')->create(['thread_id'=>$this->thread->id]); 
        //When we visit thread page
        $response = $this->get($this->thread->path())
                    ->assertSee($reply->body);
    }

    /** @test **/
    public function a_thread_can_make_a_string_path(){
        $thread = create('App\Thread');
        $this->assertEquals('/thread/'.$thread->channel->slug.'/'.$thread->id, $thread->path());
    }
}
