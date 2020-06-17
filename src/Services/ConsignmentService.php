<?php

namespace App\Services;

use App\Repositories\ConsignmentRepository;

class ConsignmentService
{
    private ConsignmentRepository $consignmentRepository;

    public function __construct(ConsignmentRepository $consignmentRepository)
    {
        $this->consignmentRepository = $consignmentRepository;
    }
}
