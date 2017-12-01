<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    /**
     * @param Todo $todo
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Todo $todo): void
    {
        $this->_em->persist($todo);
        $this->_em->flush();
    }

    /**
     * @param Todo $todo
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Todo $todo): void
    {
        $this->_em->flush($todo);
    }
}
