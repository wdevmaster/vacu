<?php

namespace Modules\Servicio\Http\Requests;

use Modules\Servicio\Entities\Servicio;
use InfyOm\Generator\Request\APIRequest;

class CreateServicioAPIRequest extends APIRequest
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
        return Servicio::$rules;
    }
}
