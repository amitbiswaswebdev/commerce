<?php

namespace Easy\Category\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class File implements Rule
{
    protected string $field;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->field = 'File';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->field = $attribute;
        $needToRemove = 0;
        $newFileUpload = 0;
        $isPassed = true;
        if (is_array($value) && sizeof($value) > 0) {
            foreach ($value as $key => $item) {
                if ( $item['id'] && (bool) $item['show'] === false  && $item['file'] == null) {
                    $needToRemove++;
                }
                if ( !$item['id'] && $item['file'] != null) {
                    $newFileUpload++;
                }
            }
            if ($needToRemove == sizeof($value) && $newFileUpload == 0) {
                $isPassed = false;
            }
        } else {
            $isPassed = false;
        }

        return $isPassed;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No ' . $this->field . ' uploaded.';
    }
}
