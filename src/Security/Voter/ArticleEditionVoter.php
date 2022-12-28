<?php

namespace App\Security\Voter;

use App\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleEditionVoter extends Voter
//Un Voteur, c'est une classe dont la responsabilité est de voter si une action sur un objet est autorisée.
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, $subject)
        //définit si le Voteur doit voter ou non sur cette demande d'autorisation
    {
        return $attribute === 'EDIT' && $subject instanceof Article;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
        // cette fonction doit retourner  true  ou  false; c'est ici que l'on peut décrire les conditions métiers qui conditionnent l'autorisation.
    {
        // on retrouve l'utilisateur (on peut aussi ré-utiliser $this->security)
        $user = $token->getUser();

        // si l'utilisateur n'est pas authentifié, c'est non!
        if (!$user instanceof UserInterface) {
            return false;
        }

        // l'utilisateur est l'auteur de l'article
        if ($user === $subject->getAuthor()) {
            return true;
        }

        // l'utilisateur est un administrateur
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return false;

    }
}