<?php

namespace Src\Platform\Dentist\Infrastructure\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StoreDentistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'speciality_id' => 'required|string|exists:specialities,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        Log::error('Validation errors: ', [
            'errors' => $validator->errors(),
        ]);
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => "The form contains errors.",
            'validationData' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
