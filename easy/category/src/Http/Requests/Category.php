<?php

namespace Easy\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Easy\Category\Rules\File as RequiredFileRules;

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
            'title' => ['required', 'string'],
            'status' => ['required', 'boolean'],
            'banner' => [new RequiredFileRules],
            'meta_image' => [new RequiredFileRules],
            'banner.*' => ['required', 'array:id,initial_sort_index,url,name,size,file,show'],
            'meta_image.*' => ['required', 'array:id,initial_sort_index,url,name,size,file,show'],
        ];
        if ($this->id) {
            $rule['id'] = ['required', 'integer'];
            $rule['slug'] = ['required', 'string', Rule::unique('categories', 'slug')->ignore($this->id)];
            $rule['banner.*.file'] = ['nullable', 'required_without:banner.*.id', 'image','mimes:png,jpeg,jpg','max:2048'];
            $rule['meta_image.*.file'] = ['nullable', 'required_without:banner.*.id', 'image','mimes:png,jpeg,jpg','max:2048'];
        } else {
            $rule['slug'] = ['required', 'string', Rule::unique('categories', 'slug')];
            $rule['banner.*.file'] = ['required', 'image','mimes:png,jpeg,jpg','max:2048'];
            $rule['meta_image.*.file'] = ['required', 'image','mimes:png,jpeg,jpg','max:2048'];
        }
        return $rule;
    }
}
