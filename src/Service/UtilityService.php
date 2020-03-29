<?php


namespace App\Service;


class UtilityService
{

    public function JSONResponseCreation($error = null, $data = null , $message, $code){
        $response = [];
        if($error){
                $response["error"] = $message;
        }

        if($data){
            $response["data"] = $data;
            $response["message"] = $message;
        }
        $response["code"] = $code;

        return $response;

    }

}