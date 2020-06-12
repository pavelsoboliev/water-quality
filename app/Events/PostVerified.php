<?php

namespace App\Events;

use App\Entities\Post;

class PostVerified
{
    /**
     * @var Post
     */
    private $post;

    /**
     * Create a new event instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
