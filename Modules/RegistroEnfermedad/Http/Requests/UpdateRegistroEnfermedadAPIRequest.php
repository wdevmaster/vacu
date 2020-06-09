<?php

namespace Modules\RegistroEnfermedad\Http\Requests;

use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use InfyOm\Generator\Request\APIRequest;

class UpdateRegistroEnfermedadAPIRequest extends APIRequest
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
        return [];
    }
}
