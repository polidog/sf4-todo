<?php

declare(strict_types=1);

namespace App\Controller\Todo;

use App\Entity\Todo;
use App\Service\DoneTodo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

/**
 * @ParamConverter("todo",class="App:Todo")
 * @Route("/todo/{id}/done/", requirements={"id":"\d+"}, name="app_todo_done")
 * @Security("todo.isActive()")
 */
class DoneController
{
    /**
     * @var DoneTodo
     */
    private $doneTodo;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param DoneTodo        $doneTodo
     * @param RouterInterface $router
     */
    public function __construct(DoneTodo $doneTodo, RouterInterface $router)
    {
        $this->doneTodo = $doneTodo;
        $this->router = $router;
    }

    public function __invoke(Todo $todo, Request $request)
    {
        $this->doneTodo->run($todo);
        $request->getSession()->getFlashBag()->add('success', 'Updated done, id #'.$todo->getId());

        return new RedirectResponse($this->router->generate('app_default_index'));
    }
}
