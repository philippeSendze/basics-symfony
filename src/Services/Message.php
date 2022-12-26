<?php

namespace App\Services;

class Message
{
    private $message;

    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

}