<?php

namespace Modules\Negocio\Http\Requests;

use Modules\Negocio\Entities\Negocio;
use InfyOm\Generator\Request\APIRequest;

class UpdateNegocioAPIRequest extends APIRequest
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
