<?php

namespace Modules\Lote\Http\Requests;

use Modules\Lote\Entities\Lote;
use InfyOm\Generator\Request\APIRequest;

class CreateLoteAPIRequest extends APIRequest
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
        return Lote::$rules;
    }
}
