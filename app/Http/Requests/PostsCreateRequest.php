<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostsCreateRequest extends Request
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
            'title' => 'required',
            'body' => 'required',
            
            'category_id' => 'required',
            'photo_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Ο τίτλος είναι υποχρεωτικός',
        ];
    }

}
