<?php

namespace Modules\Locomocion\Http\Requests;

use Modules\Locomocion\Entities\Locomocion;
use InfyOm\Generator\Request\APIRequest;

class UpdateLocomocionAPIRequest extends APIRequest
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
        $rules = Locomocion::$rules;
        
        return $rules;
    }
}
