<?php

namespace Src\Platform\Dentist\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Dentist\Application\StoreDentistUseCase;
use Src\Platform\Dentist\Infrastructure\Validations\StoreDentistRequest;

final class StoreDentistPOSTController extends Controller
{
    public function __construct(
        private TokenServiceInterface $tokenService,
        private StoreDentistUseCase $storeDentistUseCase
    )
    {
        
    }
    public function index(StoreDentistRequest $request){
        try{
            //get JWT for current receptionist
            $token = $request->bearerToken();
            if(!$token){
                throw new AuthorizationException();
            }
            $receptionistId = $this->tokenService->validateToken($token);

            //store dentist
            $dentistId = $this->storeDentistUseCase->execute(
                $request->input('name'),
                $request->input('speciality_id'),
                $receptionistId
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'dentist_id' => $dentistId
                ],
                'message' => 'dentist created',
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