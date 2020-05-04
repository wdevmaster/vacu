<?php

namespace Modules\CondicionCorporal\Http\Requests;

use Modules\CondicionCorporal\Entities\CondicionCorporal;
use InfyOm\Generator\Request\APIRequest;

class CreateCondicionCorporalAPIRequest extends APIRequest
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
        return CondicionCorporal::$rules;
    }
}
