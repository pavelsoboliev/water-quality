<?php


namespace App\UseCases\Handlers;


use App\Repositories\Interfaces\PostRepositoryInterface;

class PostHandler
{
    public const POSTS_BY_PAGE = 5;

    /**
     * @var PostRepositoryInterface
     */
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getPosts($page)
    {
        return $this->repository->getAllPaginated($page, self::POSTS_BY_PAGE);
    }
}
