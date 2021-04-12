<?php

namespace App\Security;

use App\Entity\Blog;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BlogVoter extends Voter
{
    const EDIT = 'blog_edit';
    const DELETE = 'blog_delete';

    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        return $subject instanceof Blog;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Blog $blog */
        $blog = $subject;

        switch ($attribute) {
            case self::EDIT:
            case self::DELETE:
                return $blog->getCreatedBy() === $user;
        }

        return false;
    }
}
