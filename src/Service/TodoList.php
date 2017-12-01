<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\TodoRepository;

class TodoList
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

    /**
     * @return array
     */
    public function run(): array
    {
        return $this->repository->findAll();
    }
}
