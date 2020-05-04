<?php

namespace Modules\Ingreso\Http\Requests;

use Modules\Ingreso\Entities\Ingreso;
use InfyOm\Generator\Request\APIRequest;

class UpdateIngresoAPIRequest extends APIRequest
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
        $rules = Ingreso::$rules;
        
        return $rules;
    }
}
