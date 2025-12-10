<?php

namespace Src\Platform\Receptionist\Infrastructure\Repositories;

use App\Models\Receptionist as EloquentReceptionist;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;
use Src\Platform\Receptionist\Domain\Entities\Receptionist;

class EloquentReceptionistRepository implements ReceptionistRepositoryInterface
{
    public function findReceptionistById(string $id): ?Receptionist
    {
        $eloquentReceptionist = EloquentReceptionist::find($id);
        if(!$eloquentReceptionist){
            return null;
        }
        $receptionist = new Receptionist(
            $eloquentReceptionist->id, 
            $eloquentReceptionist->name, 
            $eloquentReceptionist->email, 
            $eloquentReceptionist->password
        );

        return $receptionist;
    }
    public function findReceptionistByEmail(string $email): ?Receptionist
    {
        $eloquentReceptionist = EloquentReceptionist::where('email', $email)->first();
        if(!$eloquentReceptionist){
            return null;
        }
        $receptionist = new Receptionist(
            $eloquentReceptionist->id, 
            $eloquentReceptionist->name, 
            $eloquentReceptionist->email, 
            $eloquentReceptionist->password
        );

        return $receptionist;
    }
}