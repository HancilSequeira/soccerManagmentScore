<?php

namespace App\AbstractClass;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

Abstract class AbstractValidation
{
    private $validator;
    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    public function validateFirstName($firstName){

        $firstNameConstraint = new Assert\NotBlank();
        $firstNameConstraint->message ="First name should not be null";
        $errors = $this->validator->validate(
            $firstName,
            $firstNameConstraint
        );

        return $errors;

    }

    public function validateLastName($lastName){
        $lastNameConstraint = new Assert\NotBlank();
        $lastNameConstraint->message ="Last name should not be null";
        $errors = $this->validator->validate(
            $lastName,
            $lastNameConstraint
        );

        return $errors;
    }

    public function validatePlayerImageURI($playerImageURI){
        $pattern = "/(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)(?:jpg|png|gif|tif|exf|svg|wfm)/i";

        $playerImageURIConstraint = new Assert\NotBlank();
        $playerImageURIConstraint->message ="Player image URI cannot be null";

        $errors = $this->validator->validate(
            $playerImageURI,
            $playerImageURIConstraint
        );
        if(!empty($errors)) {
            return $errors;
        }

        $playerImageURIConstraintURI = New Assert\Regex($pattern);
        $playerImageURIConstraintURI->message ="Not a valid image URL";

        $errors = $this->validator->validate(
            $playerImageURI,
            $playerImageURIConstraint
        );

        return $errors;
    }

    public function validateLogoURI($logoURIConstraint){
        $pattern = "/(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)(?:jpg|png|gif|tif|exf|svg|wfm)/i";

        $logoURIConstraint = new Assert\NotBlank();
        $logoURIConstraint->message ="Player image URI cannot be null";

        $errors = $this->validator->validate(
            $logoURIConstraint,
            $logoURIConstraint
        );
        if(!empty($errors)) {
            return $errors;
        }

        $logoURIConstraint = New Assert\Regex($pattern);
        $logoURIConstraint->message ="Not a valid image URL";

        $errors = $this->validator->validate(
            $logoURIConstraint,
            $logoURIConstraint
        );

        return $errors;
    }

    public function validateName($name){

        $nameConstraint = new Assert\NotBlank();
        $nameConstraint->message ="First name should not be null";
        $errors = $this->validator->validate(
            $name,
            $nameConstraint
        );

        return $errors;
    }

    public function validatePlayerId($playerId){
        $playerIdConstraint = new Assert\NotBlank();
        $playerIdConstraint->message ="Player Id should not be null";
        $errors = $this->validator->validate(
            $playerId,
            $playerIdConstraint
        );

        return $errors;
    }

    public function validateTeamId($teamId){
        $teamId = new Assert\NotBlank();
        $teamId->message ="Player Id should not be null";
        $errors = $this->validator->validate(
            $teamId,
            $teamId
        );

        return $errors;
    }



}