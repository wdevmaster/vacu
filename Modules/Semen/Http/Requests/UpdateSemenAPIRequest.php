<?php

namespace Modules\Semen\Http\Requests;

use Modules\Semen\Entities\Semen;
use InfyOm\Generator\Request\APIRequest;

class UpdateSemenAPIRequest extends APIRequest
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
