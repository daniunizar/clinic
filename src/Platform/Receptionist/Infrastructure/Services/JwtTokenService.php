<?php

namespace Src\Platform\Receptionist\Infrastructure\Services;

use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Src\Platform\Receptionist\Domain\Entities\Receptionist;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtTokenService implements TokenServiceInterface
{
    private string $secret;
    private int $expiry; // expiry time in seconds

    public function __construct()
    {
        $this->secret = env('JWT_SECRET', 'supersecretkey');
        $this->expiry = 604800; // 1 week (in seconds)
    }

    public function generateToken(Receptionist $user): string
    {
        $now = time();

        $payload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'iat' => $now,
            'exp' => $now + $this->expiry
        ];

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function validateToken(string $token): ?string
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
            return $decoded->sub; //sub is the receptionist Id in our database
        } catch (\Exception $e) {
            return null;
        }
    }
}