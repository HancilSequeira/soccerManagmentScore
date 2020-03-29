<?php

namespace App\Service;

use App\AbstractClass\AbstractValidation;
use App\Entity\Players;
use Symfony\Component\Validator\Validation;

class PlayerService extends AbstractValidation
{


    public function validatePlayerData($playerData){

        $firstNameError = $this->validateFirstName($playerData['firstName']);

        if(!empty($firstNameError)){
            return  $firstNameError;
        }

        $lastNameError = $this->validateLastName($playerData['lastName']);

        if(!empty($lastNameError)){
            return  $lastNameError;
        }

        $playerImageURI = $this->validatePlayerImageURI($playerData['playerImageURI']);

        if(!empty($playerImageURI)){
            return  $lastNameError;

        }

    }

}