<?php

namespace App\Commands;

use App\Exceptions\DatabaseException;
use App\Services\BatchService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartBatchCommand extends Command
{
    private BatchService $batchService;

    public function __construct(string $name, BatchService $batchService)
    {
        parent::__construct($name);

        $this->batchService = $batchService;
    }

    protected function configure(): void
    {
        $this->setDescription('Starts current batch');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $output->write('Starting a new batch', true);
            $batch = $this->batchService->startNewBatch();
            $output->write(sprintf('Successfully started a new batch: %s', $batch->getId()), true);
        } catch (DatabaseException $exception) {
            error_log($exception->getMessage());
            return self::FAILURE;
        }
        return self::SUCCESS;
    }
}
