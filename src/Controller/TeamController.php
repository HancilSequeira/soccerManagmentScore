<?php

namespace App\Controller;

use App\constant\CustomResponseConstant;
use App\Entity\Players;
use App\Entity\Team;
use App\Entity\TeamPlayer;
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
                $response = $this->utilityService->JSONResponseCreation($error, null, CustomResponseConstant::VALIDATION_ERROR, Response::HTTP_OK);
            } else {
                $data = $request->request->all();
                if (!empty($request->query->get('id'))) {
                    $teamObject = $this->em->getRepository(Team::class)->find($request->query->get('id'));
                    if ($teamObject instanceof Team) {
                        $teamObject->setName($data["name"]);
                        $teamObject->setLogoURI($data["logoURI"]);
                        $this->em->persist($teamObject);
                    }
                } else {
                    $teamObject = new Team();
                    $teamObject->setName($data["name"]);
                    $teamObject->setLogoURI($data["logoURI"]);
                    $this->em->persist($teamObject);
                };
                $this->em->flush();

                $response = $this->utilityService->JSONResponseCreation(null, $request->request->all(), CustomResponseConstant::USER_DATA_SET, Response::HTTP_OK);
            }
            return $response;
        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation(CustomResponseConstant::INTERNAL_SERVER, null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }

    /**
     * This action is used to add player to team
     * Method: POST
     * Params: playerId, teamId
     * @param Request $request
     * @return JsonResponse
     */
    public function addPlayerToTeamAction(Request $request){
        try {
            $error = $this->teamService->validateTeamPlayerData($request->request->all());

            if (!empty($error)) {
                $response = $this->utilityService->JSONResponseCreation($error, null, CustomResponseConstant::VALIDATION_ERROR, Response::HTTP_OK);
            } else {
                $data = $request->request->all();
                $teamObject = $this->em->getRepository(Team::class)->find($data["teamId"]);

                if (!$teamObject instanceof Team) {
                    $response = $this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::INVALID_TEAM, Response::HTTP_OK);
                } else {

                    $playerObject = $this->em->getRepository(Players::class)->find($data["playerId"]);

                    if (!$playerObject instanceof Players) {
                        $response = $this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::INVALID_USER, Response::HTTP_OK);
                    } else {
                        $teamPlayer = new TeamPlayer();
                        $teamPlayer->setPlayer($playerObject);
                        $teamPlayer->setTeam($teamObject);
                        $this->em->persist($teamPlayer);
                        $this->em->flush();

                        $response = $this->utilityService->JSONResponseCreation(null, $request->request->all(), CustomResponseConstant::USER_DATA_SET, Response::HTTP_OK);
                    }
                }
            }
            return new JsonResponse($response);
        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation(CustomResponseConstant::INTERNAL_SERVER, null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }

    /**
     * This action is used list all the team
     * @param Request $request
     * @return JsonResponse
     */
    public function teamListAction(Request $request){
        try{
            $teamListArray = $this->em->getRepository(Team::class)->getTeamList();
            if(empty($teamListArray)){
                $response = $this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::NO_DATA, Response::HTTP_OK);
            } else {
                $response = $this->utilityService->JSONResponseCreation(null, $teamListArray, CustomResponseConstant::USER_DATA_SET, Response::HTTP_OK);
            }
            return new JsonResponse($response);
        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation(CustomResponseConstant::INTERNAL_SERVER, null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }

    /**
     * This action is used to fetch player
     * based on team id or name
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function playerListBasedOnTeamAction(Request $request, $id){
        try{
            $playerBasedOnTeamArray = $this->em->getRepository(Team::class)->getPlayerListBasedOnTeam($id);
            if(empty($playerBasedOnTeamArray)){
                $response = $this->utilityService->JSONResponseCreation(null, null, CustomResponseConstant::NO_DATA, Response::HTTP_OK);
            } else {
                $response = $this->utilityService->JSONResponseCreation(null, $playerBasedOnTeamArray, CustomResponseConstant::USER_DATA_SET, Response::HTTP_OK);
            }
            return new JsonResponse($response);
        } catch (\Exception $e){
            return new JsonResponse($this->utilityService->JSONResponseCreation(CustomResponseConstant::INTERNAL_SERVER, null, CustomResponseConstant::INTERNAL_SERVER, Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }


}