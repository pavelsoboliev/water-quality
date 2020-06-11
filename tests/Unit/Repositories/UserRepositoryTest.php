<?php


namespace Repositories;


use App\Entities\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use WithFaker;

    private function getUser(): User
    {
        return new User(
            $this->faker->unique()->randomDigitNotNull,
            $this->faker->unique()->userName,
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
        $user = $this->getUser();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('insert')
            ->with([
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'full_name' => $user->getFullName()
            ])
            ->willReturn(true);

        $repository = new UserRepository();
        $repository->create($user);
    }

    public function testUpdate()
    {
        $user = $this->getUser();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('where')
            ->with('id', $user->getId())
            ->willReturn($qb);

        $qb->expects($this->once())
            ->method('update')
            ->with([
                'username' => $user->getUsername(),
                'full_name' => $user->getFullName()
            ])
            ->willReturn(true);

        $repository = new UserRepository();
        $repository->update($user);
    }

    public function testFindById()
    {
        $user = $this->getUser();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('where')
            ->with('id', $user->getId())
            ->willReturn($qb);

        $result = (object)[
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'full_name' => $user->getFullName()
        ];

        $qb->expects($this->once())
            ->method('first')
            ->willReturn($result);

        $repository = new UserRepository();
        $user2 = $repository->findById($user->getId());

        $this->assertEquals($user->getId(), $user2->getId());
        $this->assertEquals($user->getUsername(), $user2->getUsername());
        $this->assertEquals($user->getFullName(), $user2->getFullName());
    }
}
