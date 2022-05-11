<?php

namespace App\Http\Requests\dashbord;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            "name_en" => 'required||string',
            "name_ar" => 'required||string',
            "price"   => 'required||numeric',
            "description_en" => 'required||string',
            "description_ar" => 'required||string',
            "category_id" => 'required||integer',
            "award_name_en" => 'required||string',
            "award_name_ar" => 'required||string',
            "award_description_en" => 'required||string',
            "award_description_ar" => 'required||string',
            "image" => 'required||string',
            "award_image" => 'required||string'
        ];
    }
}
