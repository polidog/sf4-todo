<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\TodoType;
use App\Service\TodoList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var TodoList
     */
    private $todoList;

    /**
     * @param FormFactoryInterface $formFactory
     * @param TodoList             $todoList
     */
    public function __construct(FormFactoryInterface $formFactory, TodoList $todoList)
    {
        $this->formFactory = $formFactory;
        $this->todoList = $todoList;
    }

    /**
     * @Route("/")
     * @Template
     */
    public function index()
    {
        $todoForm = $this->formFactory->create(TodoType::class);

        return [
            'todoForm' => $todoForm->createView(),
            'todos' => $this->todoList->run(),
        ];
    }
}
