<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\JsonFormRequest;

class StationRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }
}
