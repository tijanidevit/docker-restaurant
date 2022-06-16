<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->method == "POST") {
            return [
                'name' => 'required| bail',
                'description' =>'required| bail',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000|bail',
                'price' =>'required| bail',
            ];
        }
        else{
            return [
                'name' => 'required| bail',
                'description' =>'required| bail',
                'price' =>'required| bail',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Restauarant\'s name is required!',
        ];
    }
}
