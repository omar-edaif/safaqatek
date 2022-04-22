<?php

namespace App\Http\Requests\api;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        return [
            'username' => 'string',
            'email' => 'unique:users,email||email',
            'currency' => 'in:' . implode(',', Currency::whereActive(true)->pluck('code')->toArray()),
            'nationality_id'   => 'integer',
            'residence_id'      => 'integer',
            'addresse' => 'string',
            'avatar' => 'mimes:jpeg,png,jpg',
            'lang' => 'in:en,ar',
            'sex' => 'in:male,female'
        ];
    }
}
