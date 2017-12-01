<?php

declare(strict_types=1);

namespace App\Controller\Todo;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Service\AddTodo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class NewController.
 *
 * @Route("/todo/new/",name="app_todo_new")
 * @Method("post")
 */
class NewController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddTodo
     */
    private $addTodo;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param FormFactoryInterface $formFactory
     * @param AddTodo              $addTodo
     * @param RouterInterface      $router
     */
    public function __construct(FormFactoryInterface $formFactory, AddTodo $addTodo, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->addTodo = $addTodo;
        $this->router = $router;
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function __invoke(Request $request)
    {
        /** @var FlashBagInterface $flashBag */
        $flashBag = $request->getSession()->getFlashBag();
        $route = $this->router->generate('app_default_index');

        $form = $this->formFactory->create(TodoType::class);
        $form->handleRequest($request);

        if (false === $form->isValid()) {
            $flashBag->add('danger', 'Invalid form data');

            return new RedirectResponse($route);
        }

        /** @var Todo $todo */
        $todo = $form->getData();
        $this->addTodo->run($todo);
        $flashBag->add('success', sprintf('Created Todo, id #%d', $todo->getId()));

        return new RedirectResponse($route);
    }
}
