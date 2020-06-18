<?php

namespace App\Entities;

class Consignment
{
    private int $id;
    private int $uniqueReference;
    private Courier $courier;
    private Batch $batch;

    public function __construct(int $id, int $uniqueReference, Courier $courier, Batch $batch)
    {
        $this->id = $id;
        $this->uniqueReference = $uniqueReference;
        $this->courier = $courier;
        $this->batch = $batch;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUniqueReference(): int
    {
        return $this->uniqueReference;
    }

    public function setUniqueReference(int $uniqueReference): Courier
    {
        $this->uniqueReference = $uniqueReference;
        return $this;
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
