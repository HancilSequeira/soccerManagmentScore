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

        $logoURIError = $this->validateLogoURI($playerData['logoURI']);

        if(!empty($logoURIError)){
            foreach ($logoURIError as $err) {
                return $err;
            }
        }

    }

}