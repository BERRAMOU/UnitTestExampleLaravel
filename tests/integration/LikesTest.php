<?php

namespace tests\integration;


use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LikesTest extends TestCase
{

//    use DatabaseTransactions;

    /**
     * @test
     */
    public function a_user_can_like_a_post()
    {
        //create a  post
        $post = factory(Post::class)->create();

        //create a user
        $user = factory(User::class)->create();
        $this->be($user);
//        $this->actingAs($user);
        $post->like();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post),

        ]);

        $this->assertTrue($post->isLiked());
    }


    /**
     * @test
     */
    public function a_user_can_unlike_a_post()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);

        $post->like();
        $post->unlike();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post),

        ]);

        $this->assertFalse($post->isLiked());

    }


    /**
     * @test
     */
    public function a_user_can_toggle_a_posts_like_status()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);

        $post->toggle();
        $this->assertTrue($post->isLiked());

        $post->toggle();
        $this->assertFalse($post->isLiked());

    }

    /**
     * @test
     */
    public function a_posts_knows_how_many_likes_it_has()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);
        $post->like();
//        $this->assertTrue($post->isLiked());
        $this->assertEquals(1 , $post->likesCount);
    }

   
}