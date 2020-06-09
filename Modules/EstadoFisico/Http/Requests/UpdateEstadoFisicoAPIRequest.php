<?php

namespace Modules\EstadoFisico\Http\Requests;

use Modules\EstadoFisico\Entities\EstadoFisico;
use InfyOm\Generator\Request\APIRequest;

class UpdateEstadoFisicoAPIRequest extends APIRequest
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
