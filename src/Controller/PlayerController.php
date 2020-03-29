<?php

namespace App\Controller;

use App\constant\CustomResponseConstant;
use App\Entity\Players;
use App\Entity\TeamPlayer;
use App\Service\PlayerService;
use App\Service\UtilityService;
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
    private $utilityService;

    public function __construct(EntityManagerInterface $em, PlayerService $playerService, UtilityService $utilityService)
    {
        $this->em = $em;
        $this->playerService = $playerService;
        $this->utilityService = $utilityService;
    }

    /**
     * If we want to inset the record then we must follow the following
     *      Method : Post
     *      Data :
     *              firstName,lastName,playerImageURI
     * If we want to update the record then we must follow the following
     *      Method: PUT
     *      Url : Need to pass id in the url (?id=1)
     *      Data :
     *              firstName,lastName,playerImageURI
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request){
        try {
            $error = $this->playerService->validatePlayerData($request->request->all());
            if (!empty($error)) {
                return new JsonResponse($this->utilityService->JSONResponseCreation($error, null, CustomResponseConstant::VALIDATION_ERROR, Response::HTTP_OK));
            }
            $data = $request->request->all();
            $playerObject = $this->em->getRepository(Players::class)->find($request->query->get('id'));

            if ($playerObject instanceof Players) {
                $playerObject->setFirstName($data["firstName"]);
                $playerObject->setLastName($data["lastName"]);
                $playerObject->setPlayerImageUri($data["playerImageURI"]);
                $this->em->persist($playerObject);
            } else {
                $playerObject = new Players();
                $playerObject->setFirstName($data["firstName"]);
                $playerObject->setLastName($data["lastName"]);
                $playerObject->setPlayerImageUri($data["playerImageURI"]);
                $this->em->persist($playerObject);
            };
            $this->em->flush();

            return new JsonResponse($this->utilityService->JSONResponseCreation(null, $request->request->all(), CustomResponseConstant::USER_DATA_SET, Response::HTTP_OK));
        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation($e->getMessage(), null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }

    public function deleteAction(Request $request){
        try{
            $playerId = $request->query->get('playerId');

            if($playerId){
                $playerObject = $this->em->getRepository(Players::class)->find($playerId);

                if($playerObject instanceof Players){
                    $player = $this->em->getRepository(Players::class)->deletePlayerById($playerId);
                    return new JsonResponse($this->utilityService->JSONResponseCreation(null,$request->query->all() , CustomResponseConstant::USER_DELETED, Response::HTTP_OK));
                } else {
                    return new JsonResponse($this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::INVALID_USER, Response::HTTP_OK));
                }

            } else {
                return new JsonResponse($this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::INVALID_REQUEST_PARAMS, Response::HTTP_OK));
            }

        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation($e->getMessage(), null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }

}