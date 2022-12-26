<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="author")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column (type="string")
     */
    public $name;

    /**
     * @ORM\Column (type="datetime", name="date_of_birth")
     */
    public $dateOfBirth;

    /**
     * @ORM\Column (type="text")
     */
    public $biography;
}