<?php

namespace Src\Platform\Receptionist\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Src\Platform\Receptionist\Application\LoginReceptionistUseCase;
use Src\Platform\Receptionist\Infrastructure\Validations\LoginReceptionistRequest;
use Symfony\Component\HttpFoundation\Response;

final class LoginReceptionistPOSTController extends Controller
{
    public function __construct(
        private LoginReceptionistUseCase $loginReceptionistUseCase
    )
    {
        
    }

    public function index(LoginReceptionistRequest $request){
        try{
            $jwt = $this->loginReceptionistUseCase->execute($request->input('email'), $request->input('password'));
    
            return response()->json([
                'success' => true,
                'data' => $jwt,
                'message' => 'user logged',
            ], Response::HTTP_OK);
        }catch(\Exception $e){
            Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}