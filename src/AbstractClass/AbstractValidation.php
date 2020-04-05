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

    public function validateName($name){

        $firstNameConstraint = new Assert\NotBlank();
        $firstNameConstraint->message ="Name should not be null";
        $errors = $this->validator->validate(
            $name,
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

    public function validateImageURI($imageURI){
        $pattern = "/(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)(?:jpg|png|gif|tif|exf|svg|wfm)/i";

        $playerImageURIConstraint = new Assert\NotBlank();
        $playerImageURIConstraint->message ="Image URI cannot be null";

        $errors = $this->validator->validate(
            $imageURI,
            $playerImageURIConstraint
        );
        if(!empty($errors)) {
            return $errors;
        }

        $playerImageURIConstraintURI = New Assert\Regex($pattern);
        $playerImageURIConstraintURI->message ="Not a valid image URL";

        $errors = $this->validator->validate(
            $imageURI,
            $playerImageURIConstraint
        );

        return $errors;
    }

    public function validateId($id){
        $playerIdConstraint = new Assert\NotBlank();
        $playerIdConstraint->message ="Player Id should not be null";
        $errors = $this->validator->validate(
            $id,
            $playerIdConstraint
        );

        return $errors;
    }

}