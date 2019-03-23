<?php

namespace LaraTest\Http\Requests;

use LaraTest\Post;
use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // We do not handle authorisation here so we can return true
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
            'cover_image' => 'image|nullable|max:1999'
            //
        ];
    }
}
