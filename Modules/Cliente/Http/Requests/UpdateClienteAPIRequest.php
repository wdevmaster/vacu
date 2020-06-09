<?php

namespace Modules\Cliente\Http\Requests;

use Modules\Cliente\Entities\Cliente;
use InfyOm\Generator\Request\APIRequest;

class UpdateClienteAPIRequest extends APIRequest
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
