<?php

namespace Modules\Lactancia\Http\Requests;

use Modules\Lactancia\Entities\Lactancia;
use InfyOm\Generator\Request\APIRequest;

class CreateLactanciaAPIRequest extends APIRequest
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
        return Lactancia::$rules;
    }
}
