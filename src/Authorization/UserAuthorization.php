<?php

namespace App\Authorization;

use App\constant\CustomResponseConstant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserAuthorization extends  EntityRepository implements UserProviderInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public function loadUserByUsername($username)
    {
        $q = $this
            ->createQueryBuilder('u')
            ->select('u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()->getResult();

        if(!$q){
            return new JsonResponse($this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::INVALID_USER, Response::HTTP_UNAUTHORIZED));
        }
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }
}