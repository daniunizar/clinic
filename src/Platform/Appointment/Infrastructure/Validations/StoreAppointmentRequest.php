<?php

namespace Src\Platform\Appointment\Infrastructure\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'required|string|exists:patients,id',
            'dentist_id' => 'required|string|exists:dentists,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'duration_in_minutes' => 'nullable|integer|min:30',
            'description' => 'required|string',
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
