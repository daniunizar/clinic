<?php

namespace Src\Platform\Patient\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Src\Platform\Patient\Application\StorePatientUseCase;
use Src\Platform\Patient\Infrastructure\Validations\StorePatientRequest;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;

final class StorePatientPOSTController extends Controller
{
    public function __construct(
        private TokenServiceInterface $tokenService,
        private StorePatientUseCase $storePatientUseCase
    )
    {
        
    }
    public function index(StorePatientRequest $request){
        try{
            //get JWT for current receptionist
            $token = $request->bearerToken();
            if(!$token){
                throw new AuthorizationException();
            }
            $receptionistId = $this->tokenService->validateToken($token);

            //store patient
            $patientId = $this->storePatientUseCase->execute(
                $request->input('name'),
                $request->input('email'),
                $request->input('phone'),
                $request->input('description'),
                $receptionistId
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'patient_id' => $patientId
                ],
                'message' => 'patient created',
            ], Response::HTTP_CREATED);
            
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