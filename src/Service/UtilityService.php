<?php


namespace App\Service;


class UtilityService
{

    public function JSONResponseCreation($error = null, $data = null , $message, $code){
        $response = [];

        $response["error"] = !empty($error) ?? [];

        $response["data"] = $data ?? [];

        $response["message"] = $message;

        $response["code"] = $code;

        return $response;

    }

}