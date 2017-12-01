<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 * @ORM\Table("todos")
 */
class Todo
{
    public const INCOMPLETE = 1;
    public const COMPLETE = 2;

    private static $names = [
        self::INCOMPLETE => 'incomplete',
        self::COMPLETE => 'completed',
    ];

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return self::$names[$this->status];
    }

    /**
     * @param string $title
     * @param int    $status
     */
    public function update(string $title): void
    {
        $this->title = $title;
        $this->updatedAt = new \DateTime();
    }

    public function done(): void
    {
        $this->status = self::COMPLETE;
        $this->updatedAt = new \DateTime();
    }

    public function isActive(): bool
    {
        return self::INCOMPLETE === $this->status;
    }

    /**
     * @param string $title
     *
     * @return Todo
     */
    public static function create(string $title): self
    {
        $self = new self();
        $self->status = self::INCOMPLETE;
        $self->title = $title;
        $self->createdAt = new \DateTime();
        $self->updatedAt = new \DateTime();

        return $self;
    }
}
