<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Professor;

class UniqueProfessor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return ! Professor::where('user_id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Já existe um professor cadastrado com esse ID de usuário.';
    }
}
