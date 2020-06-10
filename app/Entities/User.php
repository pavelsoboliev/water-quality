<?php


namespace App\Entities;


class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $full_name;

    /**
     * User constructor.
     * @param int $id
     * @param string $username
     * @param string $full_name
     */
    public function __construct(int $id, string $username, string $full_name)
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }
}
