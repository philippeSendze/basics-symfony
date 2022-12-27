<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Author;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/new")
     */
    public function new(Request $request) {
        $article = new Article();
        $publicationDate = new \DateTime('now');
        $article->setTitle('Hello world');
        $article->setContent("Un très court article.");
        //$article->setAuthor("Philippe Sendze");
        $article->setDate($publicationDate);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $authorRepository = $this->getDoctrine()->getRepository(Author::class);
            $author = $authorRepository->findOneBy(['name' => 'Philippe Sendze']);
            $em->persist($article);
            $em->flush();
        }

        return $this->render('new_article.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}