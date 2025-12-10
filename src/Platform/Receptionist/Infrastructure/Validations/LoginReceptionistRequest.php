<?php

namespace Src\Platform\Receptionist\Infrastructure\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LoginReceptionistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function failedValidation(Validator $validator){
        Log::error('Validation errors: ', [
            'errors' => $validator->errors(),
        ]);
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => __('errors.form_data_error'),
            'validationData' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}