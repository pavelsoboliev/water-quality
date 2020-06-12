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
     * @var string
     */
    private $phone;

    /**
     * User constructor.
     * @param int $id
     * @param string $username
     * @param string $full_name
     * @param string $phone
     */
    public function __construct(int $id, string $username, string $full_name, string $phone)
    {
        $this->id = $id;
        $this->username = $username;
        $this->full_name = $full_name;
        $this->phone = $phone;
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

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
