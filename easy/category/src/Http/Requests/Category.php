<?php

namespace Easy\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Category extends FormRequest
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
        $rule = [
            'status' => ['required', 'boolean'],
            'title' => ['required', 'string'],
            'banner' => ['required','image','mimes:png,jpeg,jpg','max:2048'],
            'meta_image' => ['image','mimes:png,jpeg,jpg','max:2048']
        ];
        if ($this->id) {
            $rule['slug'] = ['required', 'string', Rule::unique('categories', 'slug')->ignore($this->id)];
        } else {
            $rule['slug'] = ['required', 'string', Rule::unique('categories', 'slug')];
        }
        return $rule;
    }
}
