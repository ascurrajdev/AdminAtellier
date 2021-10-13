<?php
namespace App\Traits;
trait ResponseTrait{
    public function success($message,$code = 200){
        return response()->json([
            "data" => $message
        ],$code);
    }

    public function error($message,$code){
        return response()->json([
            "error" => $message,
            "code" => $code
        ],$code);
    }
}