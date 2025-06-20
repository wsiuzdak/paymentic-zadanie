<?php

namespace App\Rules;

use App\enum\TaskStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidTaskStatus implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, TaskStatus::values(), true)) {
            $fail("Invalid status. Allowed values: " . implode(', ', TaskStatus::values()));
        }
    }
}
