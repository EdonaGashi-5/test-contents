<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Update extends FormRequest
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
            'title' => 'required|min:5|max:60',
            'contents' => 'string|required',
            'abstract' => 'string|required',
            'status' => [
                'nullable',
                'sometimes',
                Rule::in(['0', '1'])

            ],
            'category_id' => 'integer|required|exists:categories,id'
        ];
    }
}
