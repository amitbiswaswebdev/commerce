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
        if ($this->id) {
            $rule = [
                'id' => ['required', 'integer'],
                'slug' => ['required', 'string', Rule::unique('categories', 'slug')->ignore($this->id)],
                'status' => ['required', 'boolean'],
                'title' => ['required', 'string'],
                'banner.*.file' => ['required_without:banner.*.id', 'nullable', 'image','mimes:png,jpeg,jpg','max:2048'],
                'meta_image.*.file' => ['required_without:banner.*.id', 'nullable', 'image','mimes:png,jpeg,jpg','max:2048']
            ];
        } else {
            $rule = [
                'slug' => ['required', 'string', Rule::unique('categories', 'slug')],
                'status' => ['required', 'boolean'],
                'title' => ['required', 'string'],
                'banner.*.file' => ['nullable', 'image','mimes:png,jpeg,jpg','max:2048'],
                'meta_image.*.file' => ['nullable', 'image','mimes:png,jpeg,jpg','max:2048']
            ];
        }
        return $rule;
    }
}
