<?php

namespace App\Http\Requests;

use App\Exceptions\PublicException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    /**
     * @param Validator $validator 
     * @return void 
     * @throws PublicException 
     */
    protected function failedValidation($validator)
    {
        throw PublicException::validationError($validator->errors()->first(), 'form.validation_error');
    }

    protected $stopOnFirstFailure = true;
}
