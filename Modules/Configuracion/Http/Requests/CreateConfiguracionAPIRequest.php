<?php

namespace Modules\Configuracion\Http\Requests;

use Modules\Configuracion\Entities\Configuracion;
use InfyOm\Generator\Request\APIRequest;

class CreateConfiguracionAPIRequest extends APIRequest
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
        return Configuracion::$rules;
    }
}
