<?php

namespace Modules\Animal\Http\Requests;

use Modules\Animal\Entities\Celo;
use InfyOm\Generator\Request\APIRequest;

class UpdateCeloAPIRequest extends APIRequest
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
        $rules = Celo::$rules;
        
        return $rules;
    }
}
