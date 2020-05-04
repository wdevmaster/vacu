<?php

namespace Modules\Muerte\Http\Requests;

use Modules\Muerte\Entities\Muerte;
use InfyOm\Generator\Request\APIRequest;

class UpdateMuerteAPIRequest extends APIRequest
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
        $rules = Muerte::$rules;
        
        return $rules;
    }
}
