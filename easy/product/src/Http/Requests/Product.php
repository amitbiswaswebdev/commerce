<?php

namespace Easy\Inventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class Source extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'source';

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
        $rules = [
            'status' => ['nullable', 'boolean']
        ];
        if ($this->id) {
            $rules['title'] = ['required', 'string', Rule::unique('sources', 'title')->ignore($this->id)];
        } else {
            $rules['title'] = ['required', 'string', Rule::unique('sources', 'title')];
        }
        return $rules;
    }
}
