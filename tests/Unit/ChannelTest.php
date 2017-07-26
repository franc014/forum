<?php

namespace Tests\Unit;

use App\Channel;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_channel_has_many_threads(){
        $channel = create(Channel::class);
        $thread =create(Thread::class,['channel_id'=>$channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
