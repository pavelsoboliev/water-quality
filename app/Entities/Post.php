<?php


namespace App\Entities;


class Post
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $header;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $author_name;

    /**
     * Order constructor.
     * @param int $id
     * @param string $header
     * @param string $content
     * @param string $file
     * @param string $date
     * @param string $author_name
     */
    public function __construct(int $id, string $header, string $content, string $file, string $date, string $author_name)
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
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getAuthorNmae(): string
    {
        return $this->author_name;
    }
}
