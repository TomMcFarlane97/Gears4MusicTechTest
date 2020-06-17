<?php

namespace App\Controllers;

use App\Services\ConsignmentService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ConsignmentController
{
    private ConsignmentService $consignmentService;

    public function __construct(ConsignmentService $consignmentService)
    {
        $this->consignmentService = $consignmentService;
    }

    public function create(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }
}
