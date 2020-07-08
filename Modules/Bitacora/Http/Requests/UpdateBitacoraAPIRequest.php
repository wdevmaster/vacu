<?php

namespace Modules\Bitacora\Http\Requests;

use Modules\Bitacora\Entities\Bitacora;
use InfyOm\Generator\Request\APIRequest;

class UpdateBitacoraAPIRequest extends APIRequest
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
        $rules = Bitacora::$rules;
        
        return $rules;
    }
}
