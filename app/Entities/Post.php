<?php


namespace App\Entities;


class Post
{
    /**
     * @const string
     */
    private const STATUS_NEW = 'New';
    private const STATUS_VERIFIED = 'Verified';
    private const STATUS_INFORMATION_EXPIRED = 'Information expired';

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
    public function __construct(int $id, string $header, string $content, string $file, string $date, string $author_name, string $status)
    {
        $this->id = $id;
        $this->header = $header;
        $this->content = $content;
        $this->file = $file;
        $this->date = $date;
        $this->author_name = $author_name;
        $this->status = $status ?: self::STATUS_NEW;
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
    public function getAuthorName(): string
    {
        return $this->author_name;
    }

    /**
     * @event PostVerified
     */
    public function verify(): void
    {
        $this->status = self::STATUS_VERIFIED;
        event(new PostVerified($this));
    }

    public function disable(): void
    {
        $this->status = self::STATUS_INFORMATION_EXPIRED;
    }
}
