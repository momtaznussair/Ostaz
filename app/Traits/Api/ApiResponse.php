<?php 

namespace App\Traits\Api;

trait ApiResponse {
    
    public function apiResponse($data = null, $message='', $code = 200){
        $array = [
            'status' => in_array($code , $this->successCodes()),
            'message' => $message,
            'data' => $data,
        ];

        return response($array ,$code);
    }


    public function successCodes(){
        return [
            200 , 201, 202
        ];
    }

    public function NotFoundError(){
        return $this->apiResponse(null,'Not Found',404);
    }

    public function UnknownError(){
        return  $this->apiResponse(null,'Unknown Error',400);
    }

}