<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Todo;
use App\Repository\TodoRepository;

class AddTodo
{
    /**
     * @var TodoRepository
     */
    private $todoRepository;

    /**
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * @param Todo $todo
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function run(Todo $todo): void
    {
        $this->todoRepository->add($todo);
    }
}
