<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Knot\Notifications\PostReactedTo;
use Tests\TestCase;

class ReactionsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $post;

    public function setup(): void
    {
        parent::setup();

        Notification::fake();
        $this->user = create('Knot\Models\User');
        $this->post = create('Knot\Models\Post', ['user_id' => $this->user->id]);
        $this->login();
    }

    /** @test */
    public function a_user_cannot_react_to_a_post_that_does_not_belong_to_a_friend()
    {
        $this->postJson('api/posts/'.$this->post->id.'/reactions', ['type' => 'smile'])->assertStatus(403);
    }

    /** @test */
    public function a_user_can_react_to_a_post_if_it_does_belong_to_a_friend()
    {
        $this->createFriendship(auth()->user(), $this->user);

        $this->postJson('api/posts/'.$this->post->id.'/reactions', ['type' => 'smile'])->assertStatus(200);
        $this->assertDatabaseHas('reactions', ['post_id' => $this->post->id]);
    }

    /** @test */
    public function a_reaction_type_must_be_one_of_the_set_reactions()
    {
        $this->createFriendship(auth()->user(), $this->user);

        $this->postJson('api/posts/'.$this->post->id.'/reactions', ['type' => 'cringe'])->assertStatus(422);
    }

    /** @test */
    public function a_post_author_receives_a_notification_when_someone_reacts_to_their_post()
    {
        $this->createFriendship(auth()->user(), $this->user);
        $this->postJson('api/posts/'.$this->post->id.'/reactions', ['type' => 'smile']);

        Notification::assertSentTo($this->user, PostReactedTo::class);
    }

    /** @test */
    public function a_post_author_does_not_get_a_notification_if_they_react_to_their_own_post()
    {
        $post = create('Knot\Models\Post', ['user_id' => auth()->id()]);
        $this->postJson('api/posts/'.$post->id.'/reactions', ['type' => 'smile']);

        Notification::assertNotSentTo($this->user, PostReactedTo::class);
    }
}
