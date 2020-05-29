<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\AppBaseController;

class CommonController extends AppBaseController
{
    public function sendResponse($result, $message, $success = true, $status= 200)
    {
        return response()->json([
            'message' => $message,
            'success' => $success,
            'data' => $result
        ], $status);
    }

    public function sendError($message, $status){
        return response()->json([
            'message' => $message,
            'success' => false,
        ], $status);
    }

    public function sendSuccess($message){
        return response()->json([
            'message' => $message,
            'success' => true,
        ], 200);
    }
}
