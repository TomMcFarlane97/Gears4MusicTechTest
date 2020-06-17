<?php

namespace App\Repositories;

use App\Batch\Batch;
use App\Exceptions\DatabaseException;
use Carbon\Carbon;

class BatchRepository
{
    /**
     * this function would call to the database to find the current batch by the 'endDateTime' being null
     */
    public function findCurrentBatch(): ?Batch
    {
        return $this->createBatch();
    }

    /**
     * Persist the batch that is passed to it
     */
    public function persist(Batch $batch): ?Batch
    {
        // do persist functionality

        return $batch;
    }

    public function createBatch(): Batch
    {
        return new Batch(1, Carbon::now());
    }
}
