<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //

    /**
     * Return list obj
     */
    public function successListResponse($data = [],$message = "Success")
    {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
    }

    /**
     * Return one obj
     */
    public function successObjResponse($data,$message = "Success")
    {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
    }

    /**
     * Return error not found obj
     */
    public function errorNotFound($message = "Data not found")
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => null,
            'code' => 404
        ],404);
    }

    /**
     * Return error msg
     */
    public function errorWithMessage($data,$message = "Error data tracking",$code)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ],$code);
    }

     

}
