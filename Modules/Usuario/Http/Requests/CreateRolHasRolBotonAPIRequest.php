<?php

namespace Modules\Usuario\Http\Requests;

use InfyOm\Generator\Request\APIRequest;
use Modules\Usuario\Entities\RolHasRolBoton;

class CreateRolHasRolBotonAPIRequest extends APIRequest
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
        return RolHasRolBoton::$rules;
    }
}
