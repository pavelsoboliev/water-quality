<?php


namespace App\Repositories;

use App\Entities\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use DateTimeImmutable;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;


class PostRepository implements PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function getAll(): array
    {
        $result = $this->getConnection()->get();
        $posts = [];

        foreach ($posts as $post) {
            $posts[] = new Post($post->id, $post->header, $post->content, $post->file, $post->date, $post->author_name);
        }

        return $posts;
    }

    /**
     * @return Builder
     */
    private function getConnection(): Builder
    {
        return DB::table('posts');
    }

    /**
     * @param int $id
     * @return Post
     */
    public function findById(int $id): Post
    {
        $post = $this->getConnection()->where('id', $id)->first();

        if ($post === null) {
            throw new RuntimeException('Can\'t find post with id = )' . $id);
        }

        return new Post($post->id, $post->header, $post->content, $post->file, $post->date, $post->author_name);
    }

    /**
     * @param Post $item
     */
    public function create($item)
    {
        if ($item instanceof Post) {
            $this->getConnection()->insert([
                'id' => $item->getId(),
                'header' => $item->getHeader(),
                'content' => $item->getContent(),
                'file' => $item->getFile(),
                'date' => $item->getDate(),
                'author_name' => $item->getAuthorName()
            ]);
            return;
        }

        throw new InvalidArgumentException('Cannot create non Post class: ' . get_class($item));
    }

    /**
     * @param Post $item
     */
    public function update($item)
    {
        if ($item instanceof Post) {
            $this->getConnection()->where('id', $item->getId())->update([
                'header' => $item->getHeader(),
                'content' => $item->getContent(),
                'file' => $item->getFile(),
                'date' => $item->getDate(),
                'author_name' => $item->getAuthorName()
            ]);
            return;
        }

        throw new InvalidArgumentException('Cannot create non Post class: ' . get_class($item));
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->getConnection()->delete($id);
    }
}
