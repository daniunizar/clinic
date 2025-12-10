<?php

namespace Src\Platform\Appointment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Appointment\Application\ListAppointmentsByStartDateUseCase;
use Src\Platform\Appointment\Infrastructure\Validations\ListAppointmentsByStartDateRequest;

final class ListAppointmentsByStartDateGETController extends Controller
{
    public function __construct(
        private TokenServiceInterface $tokenService,
        private ListAppointmentsByStartDateUseCase $listAppointmentsByStartDateUseCase
    )
    {
        
    }

    public function index(ListAppointmentsByStartDateRequest $request){
        try{
             //get JWT for current receptionist
             $token = $request->bearerToken();
             if(!$token){
                 throw new AuthorizationException();
             }
             $receptionistId = $this->tokenService->validateToken($token);

            //parse date from string to DateTimeImmutable
            $dateString = $request->input('date');
            $startDate = new \DateTimeImmutable($dateString);
            
            // get appointments
            $listAppointmentsByStartDatePresenter = $this->listAppointmentsByStartDateUseCase->execute($startDate, $receptionistId);
            return response()->json([
                'success' => true,
                'data' => $listAppointmentsByStartDatePresenter->read(),
                'message' => 'appointments listed',
            ], Response::HTTP_OK);
        }catch(\Illuminate\Auth\Access\AuthorizationException $e){
            Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_FORBIDDEN);
        }catch(\Exception $e){
            Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}