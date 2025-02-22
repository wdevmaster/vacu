<?php

namespace Modules\Produccion\Http\Requests;

use Modules\Produccion\Entities\Produccion;
use InfyOm\Generator\Request\APIRequest;

class UpdateProduccionAPIRequest extends APIRequest
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
