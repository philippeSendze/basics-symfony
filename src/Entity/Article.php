<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Article
{
    /**
     * @Assert\Length(
     *  min = 10,
     *  max = 70,
     *  minMessage = "Ce titre est trop court",
     *  maxMessage = "Ce titre est trop long"
     * )
     */
    private $title;

    /** @Assert\NotBlank(message="Le contenu ne peut être vide") */
    private $content;

    /** @Assert\NotBlank(message="Un auteur doit être associé à l'article") */
    private $author;

    private $date;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

}