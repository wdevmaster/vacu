<?php

namespace Modules\Inseminador\Http\Requests;

use Modules\Inseminador\Entities\Inseminador;
use InfyOm\Generator\Request\APIRequest;

class UpdateInseminadorAPIRequest extends APIRequest
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
