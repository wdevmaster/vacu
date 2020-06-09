<?php

namespace Modules\Enfermedad\Http\Requests;

use Modules\Enfermedad\Entities\Enfermedad;
use InfyOm\Generator\Request\APIRequest;

class UpdateEnfermedadAPIRequest extends APIRequest
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
