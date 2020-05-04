<?php

namespace Modules\Raza\Http\Requests;

use Modules\Raza\Entities\Raza;
use InfyOm\Generator\Request\APIRequest;

class CreateRazaAPIRequest extends APIRequest
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
        return Raza::$rules;
    }
}
