<?php

namespace App\EventListener;

use App\Events\HelloEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class HelloListener
{
    public function helloBack(HelloEvent $event) {

    }
}