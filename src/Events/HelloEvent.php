<?php

namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event;

class HelloEvent extends Event
{
    const NAME = 'hello.event';

    private $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}