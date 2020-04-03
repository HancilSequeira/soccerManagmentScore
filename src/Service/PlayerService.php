<?php

namespace App\Service;

use App\AbstractClass\AbstractValidation;
use App\Entity\Players;
use Symfony\Component\Validator\Validation;

class PlayerService extends AbstractValidation
{


    public function validatePlayerData($playerData){

        $firstNameError = $this->validateName($playerData['firstName']);

        if(!empty($firstNameError)){
            foreach ($firstNameError as $err) {
                return $err;
            }
        }

        $lastNameError = $this->validateName($playerData['lastName']);

        if(!empty($lastNameError)){
            foreach ($lastNameError as $err) {
                return $err;
            }
        }

        $playerImageURI = $this->validateImageURI($playerData['playerImageURI']);

        if(!empty($playerImageURI)){
            foreach ($playerImageURI as $err) {
                return $err;
            }
        }

    }

}