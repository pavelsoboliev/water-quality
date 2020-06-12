<?php


namespace App\Repositories\Interfaces;


use App\Entities\Post;

interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $page
     * @param int $postsByPage
     * @return Post[]
     */
    public function getAllPaginated(int $page, int $postsByPage): array;
}
