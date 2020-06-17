<?php

namespace App\Controllers;

use App\Exceptions\RequestException;
use App\Services\ConsignmentService;
use JsonException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ConsignmentController extends AbstractController
{
    private ConsignmentService $consignmentService;

    public function __construct(ConsignmentService $consignmentService)
    {
        $this->consignmentService = $consignmentService;
    }

    public function get(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('@TODO configure GET endpoint');
        return $response;
    }

    public function create(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        try {
            $this->validateRequest($request);
            $consignment = $this->consignmentService->createNewConsignment(json_decode(
                $request->getBody()->getContents(),
                true,
                512,
                JSON_THROW_ON_ERROR
            ));
            $response->getBody()->write(
                json_encode([
                    'id' => $consignment->getId(),
                    'uniqueReference' => $consignment->getUniqueReference(),
                    'courier' => $consignment->getCourier()->getId(),
                    'batch' => $consignment->getBatch()->getId(),
                ],
                JSON_THROW_ON_ERROR
                ));
        } catch (RequestException $exception) {
            $response
                ->withHeader('Content-Type', self::JSON)
                ->withStatus(self::BAD_REQUEST)
                ->getBody()->write(json_encode(['message' => $exception->getMessage()], JSON_THROW_ON_ERROR));
            return $response;
        } catch (JsonException $exception) {
            $response
                ->withHeader('Content-Type', self::JSON)
                ->withStatus(self::INTERNAL_SERVER_ERROR)
                ->getBody()->write(json_encode(['message' => $exception->getMessage()], JSON_THROW_ON_ERROR));
            return $response;
        }
        return $response
            ->withHeader('Content-Type', self::JSON)
            ->withStatus(self::CREATED);
    }

    public function put(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('@TODO configure PUT endpoint');
        return $response;
    }

    public function delete(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('@TODO configure DELETE endpoint');
        return $response;
    }
}
