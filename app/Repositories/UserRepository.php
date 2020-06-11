<?php


namespace App\Repositories;

use App\Entities\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;


class UserRepository implements UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function getAll(): array
    {
        $result = $this->getConnection()->get();
        $users = [];

        foreach ($result as $user) {
            $users[] = new User($user->id, $user->username, $user->full_name);
        }

        return $users;
    }

    /**
     * @return Builder
     */
    private function getConnection(): Builder
    {
        return DB::table('users');
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        $user = $this->getConnection()->where('id', $id)->first();

        if ($user === null) {
            throw new RuntimeException('Can\'t find user with id = )' . $id);
        }

        return new User($user->id, $user->username, $user->full_name);
    }

    /**
     * @param User $item
     */
    public function create($item)
    {
        if ($item instanceof User) {
            $this->getConnection()->insert([
                'id' => $item->getId(),
                'username' => $item->getUsername(),
                'full_name' => $item->getFullName()
            ]);
            return;
        }

        throw new InvalidArgumentException('Cannot create non User class: ' . get_class($item));
    }

    /**
     * @param User $item
     */
    public function update($item)
    {
        if ($item instanceof User) {
            $this->getConnection()->where('id', $item->getId())->update([
                'username' => $item->getUsername(),
                'full_name' => $item->getFullName()
            ]);
            return;
        }

        throw new InvalidArgumentException('Cannot create non User class: ' . get_class($item));
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->getConnection()->delete($id);
    }
}
