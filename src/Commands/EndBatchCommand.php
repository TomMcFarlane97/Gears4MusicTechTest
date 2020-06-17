<?php

namespace App\Commands;

use App\Services\BatchService;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EndBatchCommand extends Command
{
    private BatchService $batchService;

    public function __construct(string $name, BatchService $batchService)
    {
        parent::__construct($name);

        $this->batchService = $batchService;
    }

    protected function configure(): void
    {
        $this->setDescription('Ends current batch');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write('Ending Current Batch');
        try {
            $batchToEnd = $this->batchService->endCurrentBatch();
            if (!$batchToEnd) {
                $output->write('There is no batch to end');
                return self::SUCCESS;
            }
            $this->batchService->sendDataToClients($batchToEnd);
        } catch (Exception $exception) {
            error_log($exception->getMessage(), $exception->getTraceAsString());
            $output->write('Something went wrong. Check the logs');
            return self::FAILURE;
        }
        return self::SUCCESS;
    }
}
