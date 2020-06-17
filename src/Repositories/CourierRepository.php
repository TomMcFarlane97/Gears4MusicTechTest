<?php

namespace App\Repositories;

use App\Entities\Courier;

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

    /**
     * Should look up database record by ID and return one or no Courier
     */
    public function findCourierById(int $courierId): ?Courier
    {
        return self::createCourier(
            $courierId,
            Courier::COURIER_ROYAL_MAIL,
            Courier::TRANSFER_METHOD_EMAIL,
            'consigments@royalmail.com',
            20
        );
    }
}
