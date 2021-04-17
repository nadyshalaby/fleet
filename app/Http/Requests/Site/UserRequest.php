<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends JsonFormRequest
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
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('user')->id)],
            'password' => ['nullable', 'confirmed', 'min:8']
        ];
    }
}
