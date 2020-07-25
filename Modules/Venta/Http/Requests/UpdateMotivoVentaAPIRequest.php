<?php

namespace Modules\Venta\Http\Requests;

use Modules\Venta\Entities\MotivoVenta;
use InfyOm\Generator\Request\APIRequest;

class UpdateMotivoVentaAPIRequest extends APIRequest
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
        $rules = MotivoVenta::$rules;
        
        return $rules;
    }
}
