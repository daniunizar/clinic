<?php

namespace Src\Platform\Appointment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Appointment\Application\StoreAppointmentUseCase;
use Src\Platform\Appointment\Infrastructure\Validations\StoreAppointmentRequest;

final class StoreAppointmentPOSTController extends Controller
{
    public function __construct(
        private TokenServiceInterface $tokenService,
        private StoreAppointmentUseCase $storeAppointmentUseCase
    ) {}


    public function index(StoreAppointmentRequest $request)
    {
        try {
            //get JWT for current receptionist
            $token = $request->bearerToken();
            if (!$token) {
                throw new AuthorizationException();
            }
            $receptionistId = $this->tokenService->validateToken($token);

            //store appointment and get his Id
            $appointmentId = $this->storeAppointmentUseCase->execute([
                'patient_id' => $request->input('patient_id'),
                'dentist_id' => $request->input('dentist_id'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'duration_in_minutes' => $request->input('duration_in_minutes'),
                'description' => $request->input('description'),
                'receptionist_id' => $receptionistId,
            ]);

            return response()->json([
                'success' => true,
                'data' => $appointmentId,
                'message' => 'Appointment stored',
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_FORBIDDEN);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
