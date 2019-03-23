<?php

namespace LaraTest\Http\Requests;

use LaraTest\Post;
use Illuminate\Http\Request;
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
    public function rules(Request $request)
    {
        // Get the http method
        $method = $request->method();

        switch($method)
        {
            case 'POST':
                return $this->storeRules();
            case 'PUT':
                return $this->updateRules();
        }
    }

    public function storeRules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
            //
        ];
    }

    public function updateRules()
    {
        // Change not needed to the image. This is more for 
        // demonstration purposes as you can leave the title and 
        // body unaltered as well. 
        return [
            'title' => 'required',
            'body' => 'required'
        ];
    }
}
