<?php

namespace App\Repositories;

use App\Batch\Courier;

class CourierRepository
{
    public static function createCourier(
        int $id,
        string $name,
        string $dataTransferMethod,
        string $dataTransferLocation,
        int $uniqueGeneration,
        ?string $login = null,
        ?string $password = null
    ): Courier {
        return new Courier($id, $name, $dataTransferMethod, $dataTransferLocation, $uniqueGeneration, $login, $password);
    }
}
