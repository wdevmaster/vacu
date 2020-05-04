<?php

namespace Modules\TipoServicio\Http\Requests;

use Modules\TipoServicio\Entities\TipoServicio;
use InfyOm\Generator\Request\APIRequest;

class UpdateTipoServicioAPIRequest extends APIRequest
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
        $rules = TipoServicio::$rules;
        
        return $rules;
    }
}
