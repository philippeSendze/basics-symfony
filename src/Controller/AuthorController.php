<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/new")
     */
    public function new (Request $request) {
        $author = new Author();
        $author->setName('Philippe Sendze');
        $author->setBiography('Since his childhood, he loves to write.');
        $author->setDateOfBirth(new \DateTime('1999-10-20'));

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($author);
            $em->flush();
        }

        return $this->render('new_author.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /** @Route("/author/edit/{id<\d+>}") */
    public function edit(Request $request, Author $author) {
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('new_author.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /** @Route("/author/delete/{id<\d+>}") */
    public function delete(Request $request, Author $author) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($author);
        $em->flush();

        return $this->redirectToRoute('/author/new');
    }
}