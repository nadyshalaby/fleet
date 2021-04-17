<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\JsonFormRequest;

class AuthRequest extends JsonFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required'],
            'password' => ['required'],
        ];
    }
}
