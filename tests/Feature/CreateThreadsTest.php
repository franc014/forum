<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Broadcasting\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_forum_threads()
    {

        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')->assertRedirect('/login');
    }



    /** @test */
    public function an_authenticated_user_can_create_new_forum_thread()
    {

        $this->signIn();


        $thread = make(Thread::class);//wrong: create(Thread::class); because it'll create the thread without passing through the api call

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /** @test */
    public function a_thread_requires_a_title(){

        $this->publishThread(['title'=>null])->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_thread_requires_a_body(){

        $this->publishThread(['body'=>null])->assertSessionHasErrors('body');

    }


    /** @test */
    public function a_thread_requires_a_channel_id(){
        factory('App\Channel',2)->create();

        $this->publishThread(['channel_id'=>null])->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id'=>999])->assertSessionHasErrors('channel_id');

    }

    private function publishThread($overrides = []){
        $this->signIn()->withExceptionHandling();
        $thread = make(Thread::class,$overrides);
        return $this->post('/threads', $thread->toArray());
    }

}
