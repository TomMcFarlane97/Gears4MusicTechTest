<?php

namespace App\Batch;

class Courier
{
    public const COURIER_ROYAL_MAIL = 'Royal Mail';
    public const COURIER_ANC = 'ANC';
    public const TRANSFER_METHOD_FTP = 'FTP';
    public const TRANSFER_METHOD_EMAIL = 'EMAIL';

    private int $id;
    private string $name;
    private string $dataTransferMethod;
    private string $dataTransferLocation;
    private int $uniqueGeneration;
    private ?string $login = null;
    private ?string $password = null;

    /** @var Consignment[] */
    private array $consignments = [];

    public function __construct(
        int $id,
        string $name,
        string $dataTransferMethod,
        string $dataTransferLocation,
        int $uniqueGeneration,
        ?string $login,
        ?string $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->dataTransferMethod = $dataTransferMethod;
        $this->dataTransferLocation = $dataTransferLocation;
        $this->uniqueGeneration = $uniqueGeneration;
        $this->login = $login;
        $this->password = $password;
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

    public function getUniqueGeneration(): int
    {
        return $this->uniqueGeneration;
    }

    public function setUniqueGeneration(int $uniqueGeneration): Courier
    {
        $this->uniqueGeneration = $uniqueGeneration;
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): Courier
    {
        $this->login = $login;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): Courier
    {
        $this->password = $password;
        return $this;
    }
}
