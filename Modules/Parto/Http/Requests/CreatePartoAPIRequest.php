<?php

namespace Modules\Parto\Http\Requests;

use Modules\Parto\Entities\Parto;
use InfyOm\Generator\Request\APIRequest;

class CreatePartoAPIRequest extends APIRequest
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
        return Parto::$rules;
    }
}
