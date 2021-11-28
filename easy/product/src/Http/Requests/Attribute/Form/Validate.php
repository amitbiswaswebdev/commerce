<?php

namespace Easy\Product\Http\Requests\Attribute\Form;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\matches;

class Validate extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'product_attribute';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'level' => ['required', 'string'],
            'input' =>  ['required', 'string'],
            'required' => ['required', 'boolean'],
            'user_defined' => ['nullable', 'boolean'],
            'model_value' => ['nullable', 'string'],
            'show_in_frontend_features' => ['required', 'boolean'],
        ];

        if ($this->id) {
            $rules['id'] = ['required', 'integer'];
            $rules['code'] = ['required', 'string', Rule::unique('product_attributes', 'code')->ignore($this->id)];
        } else {
            $rules['code'] = ['required', 'string', Rule::unique('product_attributes', 'code')];
        }

        $type = $this->input;
        if ($type === 'text') {
            $rules['default_value'] = ['nullable', 'string'];
            $rules['options'] = ['nullable'];
        }
        return $rules;
    }

}
