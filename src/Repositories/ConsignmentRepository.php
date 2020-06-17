<?php

namespace App\Repositories;

use App\Batch\Batch;
use App\Batch\Consignment;
use App\Batch\Courier;
use Exception;

class ConsignmentRepository
{
    /**
     * @param Batch $batch
     * @return Consignment[]
     * @throws Exception
     */
    public function findAllConsignmentsFromBatch(Batch $batch): array
    {
        // find all consignments by the batch

        // The dataTransferLocation's should really be a constant but in reality, would be getting this from the database
        $royalMailCourier = CourierRepository::createCourier(
            1,
            Courier::COURIER_ROYAL_MAIL,
            Courier::TRANSFER_METHOD_EMAIL,
            'consigments@royalmail.com',
            20
        );

        $ancCourier = CourierRepository::createCourier(
                1,
                Courier::COURIER_ANC,
                Courier::TRANSFER_METHOD_FTP,
                'ftp.example.com',
                40,
            'example',
            'password'
            );
        return [
            $this->createConsignment(
                1,
                $royalMailCourier->getUniqueGeneration() * random_int(0, 99),
                $royalMailCourier,
                $batch
            ),
            $this->createConsignment(
                1,
                $ancCourier->getUniqueGeneration() * random_int(0, 99),
                $ancCourier,
                $batch
            )
        ];
    }

    public function createConsignment(int $id, int $uniqueReference, Courier $courier, Batch $batch): Consignment
    {
        return new Consignment($id, $uniqueReference, $courier, $batch);
    }
}
