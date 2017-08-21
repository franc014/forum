<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;


class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create(Thread::class);

    }

    /** @test */
    public function a_user_can_view_all_threads()
    {

        $this->get('/threads')
            ->assertStatus(200)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $this->get('/threads/' . $this->thread->channel->slug . '/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }


    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);
        $this->get('/threads/' . $this->thread->channel->name . '/' . $this->thread->id)
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }


    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'JhonDoe']));

        $threadByJhon = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJhon = create('App\Thread');

        $this->get('/threads/?by=JhonDoe')->assertSee($threadByJhon->title)
            ->assertDontSee($threadNotByJhon->title);


    }


}
