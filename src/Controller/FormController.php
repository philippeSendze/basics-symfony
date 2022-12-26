<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;

class FormController extends AbstractController
{
    /**
     * @Route("/form/new")
     */
    public function new(Request $request) {
        $article = new Article();
        $publicationDate = new \DateTime('now');
        $article->setTitle('Hello world');
        $article->setContent("Un très court article.");
        $article->setAuthor("Philippe Sendze");
        $article->setDate($publicationDate);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($article);
        }

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}