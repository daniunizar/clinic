<?php

namespace Src\Platform\Appointment\Infrastructure\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class ListAppointmentsByStartDateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                Rule::date()->format('Y-m-d'),
            ],
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
