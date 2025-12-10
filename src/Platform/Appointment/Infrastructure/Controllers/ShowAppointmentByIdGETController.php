<?php

namespace Src\Platform\Appointment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Appointment\Application\ShowAppointmentByIdUseCase;
use Src\Platform\Appointment\Infrastructure\Validations\ShowAppointmentByIdRequest;

final class ShowAppointmentByIdGETController extends Controller
{
    public function __construct(
        private TokenServiceInterface $tokenService,
        private ShowAppointmentByIdUseCase $showAppointmentByIdUseCase
    )
    {
        
    }

    public function index(ShowAppointmentByIdRequest $request){
        try{
             //get JWT for current receptionist
             $token = $request->bearerToken();
             if(!$token){
                 throw new AuthorizationException();
             }
             $receptionistId = $this->tokenService->validateToken($token);
            
            // get appointment by Id
            $showAppointmentByIdPresenter = $this->showAppointmentByIdUseCase->execute($request->input('id'), $receptionistId);
            return response()->json([
                'success' => true,
                'data' => $showAppointmentByIdPresenter->read(),
                'message' => 'appointment shown',
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