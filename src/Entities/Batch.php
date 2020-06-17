<?php

namespace App\Batch;

use DateTimeInterface;

class Batch
{
    private int $id;
    private DateTimeInterface $startDateTime;
    private ?DateTimeInterface $endDateTime;

    /** @var Consignment[] */
    private array $consignments = [];

    public function __construct(int $id, DateTimeInterface $startDateTime, ?DateTimeInterface $endDateTime = null)
    {
        $this->id = $id;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStartDateTime(): DateTimeInterface
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(DateTimeInterface $startDateTime): Batch
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    public function getEndDateTime(): ?DateTimeInterface
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(?DateTimeInterface $endDateTime): Batch
    {
        $this->endDateTime = $endDateTime;
        return $this;
    }

    /**
     * @return Consignment[]
     */
    public function getConsignments(): array
    {
        return $this->consignments;
    }

    public function setConsignments(array $consignments): Batch
    {
        $this->consignments = $consignments;
        return $this;
    }

    public function addConsignment(Consignment $consignments): Batch
    {
        $this->consignments[] = $consignments;
        return $this;
    }
}
