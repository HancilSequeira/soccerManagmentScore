<?php

namespace App\Controller;

use App\constant\CustomResponseConstant;
use App\Entity\Players;
use App\Entity\Team;
use App\Service\PlayerService;
use App\Service\TeamService;
use App\Service\UtilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController
{

    private $teamService;
    private $em;
    private $utilityService;

    public function __construct(EntityManagerInterface $em, TeamService $teamService, UtilityService $utilityService)
    {
        $this->em = $em;
        $this->teamService = $teamService;
        $this->utilityService = $utilityService;
    }

    /**
     * If we want to inset the record then we must follow the following
     *      Method : Post
     *      Data :
     *              name,logoURI
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
            $error = $this->teamService->validatePlayerData($request->request->all());
            if (!empty($error)) {
                return new JsonResponse($this->utilityService->JSONResponseCreation($error, null, CustomResponseConstant::VALIDATION_ERROR, Response::HTTP_OK));
            }
            $data = $request->request->all();
            $teamObject = $this->em->getRepository(Team::class)->find($request->query->get('id'));

            if ($teamObject instanceof Team) {
                $teamObject->setName($data["name"]);
                $teamObject->setLogoURI($data["logoURI"]);
                $this->em->persist($teamObject);
            } else {
                $teamObject = new Team();
                $teamObject->setName($data["name"]);
                $teamObject->setLogoURI($data["logoURI"]);
                $this->em->persist($teamObject);
            };
            $this->em->flush();

            return new JsonResponse($this->utilityService->JSONResponseCreation(null, $request->request->all(), CustomResponseConstant::USER_DATA_SET, Response::HTTP_OK));
        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation($e->getMessage(), null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }
}