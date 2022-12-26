<?php

namespace App\Controller;

use App\EventListener\HelloListener;
use App\Events\HelloEvent;
use App\Services\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * Page d'accueil (avec le service "Hello")
     *
     * @Route("/", name="accueil")
     */
    public function home(Message $hello) {
        $response = new Response();
        $response->setContent(
            '<h1>'.$hello->getMessage().'</h1>'
        );
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    /**
     * Page de l'évènement
     *
     * @Route("/event", name="event")
     */
    public function helloIsSaid(EventDispatcherInterface $eventDispatcher) {
        $name = "Philippe";
        $event = new HelloEvent($name);
        $eventDispatcher->dispatch($event, HelloEvent::NAME);


    }

    /**
     * Hello world, avec Twig cette fois :)
     *
     * @Route("/hello/{name}", name="hello")
     */
    public function hello($name)
    {
        return $this->render('hello.html.twig', ['name' => $name]);
    }
}