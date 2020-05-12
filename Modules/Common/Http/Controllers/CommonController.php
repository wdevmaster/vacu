<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\AppBaseController;

class CommonController extends AppBaseController
{
    public function sendResponse($result, $message, $model_message, $success, $status)
    {
        return response()->json([
            'message' => __($message, [
                'model' => trans_choice($model_message, 1)
            ]),
            'success' => $success,
            'data' => $result
        ], $status);
    }
}
