<?php

namespace App\Services;

use App\Entities\Batch;
use App\Entities\Courier;
use App\Exceptions\DatabaseException;
use App\Exceptions\EndBatchException;
use App\Repositories\BatchRepository;
use App\Repositories\ConsignmentRepository;
use Carbon\Carbon;
use Exception;

class BatchService
{
    private BatchRepository $batchRepository;
    private ConsignmentRepository $consignmentRepository;
    private DataTransferringService $dataTransferringService;

    public function __construct(
        BatchRepository $batchRepository,
        ConsignmentRepository $consignmentRepository,
        DataTransferringService $dataTransferringService
    ) {
        $this->batchRepository = $batchRepository;
        $this->consignmentRepository = $consignmentRepository;
        $this->dataTransferringService = $dataTransferringService;
    }

    /**
     * @throws DatabaseException
     */
    public function endCurrentBatch(): ?Batch
    {
        $batchToEnd = $this->batchRepository->findCurrentBatch();
        if (!$batchToEnd) {
            return null;
        }
        $batchToEnd->setEndDateTime(Carbon::now());
        return $this->batchRepository->persist($batchToEnd);
    }

    /**
     * @throws DatabaseException
     */
    public function startNewBatch(): void
    {

    }

    /**
     * @throws EndBatchException
     * @throws Exception
     */
    public function sendDataToClients(Batch $batch): void
    {
        $consignments = $this->consignmentRepository->findAllConsignmentsFromBatch($batch);
        foreach ($consignments as $consignment) {
            $courier = $consignment->getCourier();
            switch ($courier->getDataTransferMethod()) {
                case Courier::TRANSFER_METHOD_FTP:
                    $ftpData[$courier->getDataTransferLocation()][] = $consignment->getUniqueReference();
                    $ftpDetails[$courier->getDataTransferLocation()][] = [
                        'login' => $courier->getLogin(),
                        'password' => $courier->getPassword(),
                    ];
                    break;
                case Courier::TRANSFER_METHOD_EMAIL:
                    $emailData[$courier->getDataTransferLocation()][] = $consignment->getUniqueReference();
                    break;
                default:
                    throw new EndBatchException(sprintf(
                        '%s is not a valid data transfer method',
                        $courier->getDataTransferMethod()
                    ));
                    break;
            }
        }

        $this->dataTransferringService->sendFtpData($ftpData ?? [], $ftpDetails ?? []);
        $this->dataTransferringService->sendEmailData($emailData ?? []);
    }
}
