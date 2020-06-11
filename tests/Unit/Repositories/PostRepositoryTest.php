<?php


namespace Repositories;


use App\Entities\Post;
use App\Repositories\PostRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use WithFaker;

    private function getPost(): Post
    {
        return new Post(
            $this->faker->unique()->randomDigitNotNull,
            $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            $this->faker->text($maxNbChars = 400),
            $this->faker->imageUrl($width = 640, $height = 480),
            $this->faker->date($format = 'Y-m-d', $max = 'now'),
            $this->faker->name
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        DB::clearResolvedInstances();
        $this->setUpFaker();
    }

    public function testCreate(): void
    {
        $post = $this->getPost();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('insert')
            ->with([
                'id' => $post->getId(),
                'header' => $post->getHeader(),
                'content' => $post->getContent(),
                'file' => $post->getFile(),
                'date' => $post->getDate(),
                'author_name' => $post->getAuthorName()
            ])
            ->willReturn(true);

        $repository = new PostRepository();
        $repository->create($post);
    }

    public function testUpdate()
    {
        $post = $this->getPost();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('where')
            ->with('id', $post->getId())
            ->willReturn($qb);

        $qb->expects($this->once())
            ->method('update')
            ->with([
                'header' => $post->getHeader(),
                'content' => $post->getContent(),
                'file' => $post->getFile(),
                'date' => $post->getDate(),
                'author_name' => $post->getAuthorName()
            ])
            ->willReturn(true);

        $repository = new PostRepository();
        $repository->update($post);
    }

    public function testFindById()
    {
        $post = $this->getPost();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('where')
            ->with('id', $post->getId())
            ->willReturn($qb);

        $result = (object)[
            'id' => $post->getId(),
            'header' => $post->getHeader(),
            'content' => $post->getContent(),
            'file' => $post->getFile(),
            'date' => $post->getDate(),
            'author_name' => $post->getAuthorName()
        ];

        $qb->expects($this->once())
            ->method('first')
            ->willReturn($result);

        $repository = new PostRepository();
        $post2 = $repository->findById($post->getId());

        $this->assertEquals($post->getId(), $post2->getId());
        $this->assertEquals($post->getHeader(), $post2->getHeader());
        $this->assertEquals($post->getContent(), $post2->getContent());
        $this->assertEquals($post->getFile(), $post2->getFile());
        $this->assertEquals($post->getDate(), $post2->getDate());
        $this->assertEquals($post->getAuthorName(), $post2->getAuthorName());
    }
}
