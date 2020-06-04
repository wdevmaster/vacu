<?php

namespace Modules\Usuario\Http\Requests;

use Modules\Usuario\Entities\UserApk;
use InfyOm\Generator\Request\APIRequest;

class CreateUserApkAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return UserApk::$rules;
    }
}
