<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Author;
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/new", name="new_article")
     */
    public function new(Request $request, Security $security) {
        dump($security->getUser());
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

    /**
     * @IsGranted("EDIT", subject="article")
     */
    public function edit(Article $article)
    {
        if (!$this->isGranted('EDIT', $article)) {
            throw $this->createAccessDeniedException();
        }
    }
}