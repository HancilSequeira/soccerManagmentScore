<?php

namespace App\Controller;

use App\Service\PlayerService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController //extends AbstractFOSRestController
{
    /**
     * @var PlayerService
     */
    private $playerService;
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em, PlayerService $playerService)
    {
        $this->em = $em;
        $this->playerService = $playerService;
    }

    public function indexAction(Request $request){
//        Response::HTTP_BAD_REQUEST
        $error = $this->playerService->validatePlayerData($request->request->all());
        if($error){
//            $errorMessages = $this->get('utility_service')->validationErrors($error);
//            dd($errorMessages);
        }
        $view = $this->view($request, 200);
        return $this->handleView($view);
    }

}