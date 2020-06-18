<?php

namespace App\Services;

use App\Entities\Consignment;
use App\Exceptions\RequestException;
use App\Repositories\BatchRepository;
use App\Repositories\ConsignmentRepository;
use App\Repositories\CourierRepository;

class ConsignmentService
{
    private ConsignmentRepository $consignmentRepository;
    private CourierRepository $courierRepository;
    private BatchRepository $batchRepository;

    public function __construct(
        ConsignmentRepository $consignmentRepository,
        CourierRepository $courierRepository,
        BatchRepository $batchRepository
    ) {
        $this->consignmentRepository = $consignmentRepository;
        $this->courierRepository = $courierRepository;
        $this->batchRepository = $batchRepository;
    }

    /**
     * @throws RequestException
     */
    public function createNewConsignment(array $data): Consignment
    {
        if (empty($data['courier']) || empty($data['uniqueReference'])) {
            throw new RequestException('Please supply valid data for consignment');
        }

        $courier = $this->courierRepository->findCourierById($data['courier']);
        if (!$courier) {
            throw new RequestException('Please supply a valid courier');
        }

        $batch = $this->batchRepository->findCurrentBatch();
        if (!$batch) {
            throw new RequestException('There is no active batch');
        }


        return $this->consignmentRepository->createConsignment(
            1,
            (int) $data['uniqueReference'] * $courier->getUniqueGeneration() ,
            $courier,
            $batch
        );
    }
}
