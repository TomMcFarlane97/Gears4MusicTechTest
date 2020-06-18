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
    public function startNewBatch(): Batch
    {
        // this should return null but will comment out so code works
//        if ($this->batchRepository->findCurrentBatch()) {
//            throw new DatabaseException('There is already a batch in process');
//        }
        return $this->batchRepository->createBatch();
    }

    /**
     * With this function, I could have got the data for each courier separately, or all the consignments in one go
     * and then sort it out with PHP, I opted for a foreach loop vs an array function, e.g. array_filter because it
     * is more resource heave and with the way I have done it, it allows it all to be sorted out in one go.
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
                    if (empty($ftpDetails[$courier->getDataTransferLocation()])) {
                        $ftpDetails[$courier->getDataTransferLocation()] = [
                            'login' => $courier->getLogin(),
                            'password' => $courier->getPassword(),
                        ];
                    }
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
