<?php

namespace App\Service;

use App\AbstractClass\AbstractValidation;

class TeamService extends AbstractValidation
{


    public function validatePlayerData($playerData){

        $nameError = $this->validateName($playerData['name']);

        if(!empty($nameError)){
            foreach ($nameError as $err) {
                return $err;
            }
        }

        $logoURIError = $this->validateImageURI($playerData['logoURI']);

        if(!empty($logoURIError)){
            foreach ($logoURIError as $err) {
                return $err;
            }
        }

    }

    public function validateTeamPlayerData($playerTeamData){
        $playerIdError = $this->validateId($playerTeamData['playerId']);

        if(!empty($playerIdError)){
            foreach ($playerIdError as $err) {
                return $err;
            }
        }

        $teamIdError = $this->validateId($playerTeamData['teamId']);

        if(!empty($teamIdError)){
            foreach ($teamIdError as $err) {
                return $err;
            }
        }
    }

}