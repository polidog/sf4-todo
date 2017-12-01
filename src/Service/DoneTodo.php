<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Todo;
use App\Repository\TodoRepository;

class DoneTodo
{
    /**
     * @var TodoRepository
     */
    private $repository;

    /**
     * @param TodoRepository $repository
     */
    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Todo $todo): void
    {
        $todo->done();
        $this->repository->update($todo);
    }
}
