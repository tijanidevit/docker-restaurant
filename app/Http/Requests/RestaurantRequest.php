<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::check();
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
                'location' =>'required| bail',
                'email' =>'required| email|unique:restaurants|bail',
                'phone' =>'required| bail',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000|bail',
                'description' =>'required| bail',
            ];
        }
        else{
            return [
                'name' => 'required| bail',
                'location' =>'required| bail',
                // 'email' =>'required| email|unique:restaurants,email,'.request()->,
                'phone' =>'required| bail',
                // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000|bail',
                'description' =>'required| bail',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Restauarant\'s name is required!',
            'email.unique' => 'Email already exist in our database!',
        ];
    }
}
