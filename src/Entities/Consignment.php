<?php

namespace App\Batch;

class Consignment
{
    private int $id;
    private Courier $courier;
    private Batch $batch;

    public function __construct(int $id, Courier $courier, Batch $batch)
    {
        $this->id = $id;
        $this->courier = $courier;
        $this->batch = $batch;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCourier(): Courier
    {
        return $this->courier;
    }

    public function setCourier(Courier $courier): Consignment
    {
        $this->courier = $courier;
        return $this;
    }

    public function getBatch(): Batch
    {
        return $this->batch;
    }

    public function setBatch(Batch $batch): Consignment
    {
        $this->batch = $batch;
        return $this;
    }
}
