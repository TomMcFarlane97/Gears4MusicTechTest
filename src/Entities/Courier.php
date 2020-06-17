<?php

namespace App\Batch;

class Courier
{
    private int $id;
    private string $name;
    private string $dataTransferMethod;
    private string $dataTransferLocation;

    /** @var Consignment[] */
    private array $consignments = [];

    public function __construct(int $id, string $name, string $dataTransferMethod, string $dataTransferLocation)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dataTransferMethod = $dataTransferMethod;
        $this->dataTransferLocation = $dataTransferLocation;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Courier
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Type of Method, FTP or email
     * @return string
     */
    public function getDataTransferMethod(): string
    {
        return $this->dataTransferMethod;
    }

    /**
     * Type of Method, FTP or email
     * @param string $dataTransferMethod
     * @return Courier
     */
    public function setDataTransferMethod(string $dataTransferMethod): Courier
    {
        $this->dataTransferMethod = $dataTransferMethod;
        return $this;
    }

    /**
     * Expected destination, can be FTP URL or email
     * @return string
     */
    public function getDataTransferLocation(): string
    {
        return $this->dataTransferLocation;
    }

    /**
     * Expected destination, can be FTP URL or email
     * @param string $dataTransferLocation
     * @return Courier
     */
    public function setDataTransferLocation(string $dataTransferLocation): Courier
    {
        $this->dataTransferLocation = $dataTransferLocation;
        return $this;
    }

    /**
     * @return Consignment[]
     */
    public function getConsignments(): array
    {
        return $this->consignments;
    }

    public function setConsignments(array $consignments): Courier
    {
        $this->consignments = $consignments;
        return $this;
    }

    public function addConsignment(Consignment $consignments): Courier
    {
        $this->consignments[] = $consignments;
        return $this;
    }
}
