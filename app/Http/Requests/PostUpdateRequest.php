<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
			'title' => 'required|min:3|max:200',
			'slug' => 'max:200',
			'excerpt' => 'max:200',
			'content_html' => 'string|min:3|max:5000',
		];
    }
}
