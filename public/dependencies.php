<?php

use App\Controllers\ConsignmentController;
use App\Repositories\BatchRepository;
use App\Repositories\ConsignmentRepository;
use App\Repositories\CourierRepository;
use App\Services\BatchService;
use App\Services\ConsignmentService;
use App\Services\DataTransferringService;

// Repositories
$container->set(ConsignmentRepository::class, static function(): ConsignmentRepository {
    return new ConsignmentRepository();
});

$container->set(BatchRepository::class, static function(): BatchRepository {
    return new BatchRepository();
});

$container->set(CourierRepository::class, static function(): CourierRepository {
    return new CourierRepository();
});

// Services
$container->set(DataTransferringService::class, static function(): DataTransferringService {
    return new DataTransferringService();
});

// Services
$container->set(ConsignmentService::class, static function() use ($container): ConsignmentService {
    return new ConsignmentService(
        $container->get(ConsignmentRepository::class),
        $container->get(CourierRepository::class),
        $container->get(BatchRepository::class),
    );
});

$container->set(BatchService::class, static function() use ($container): BatchService {
    return new BatchService(
        $container->get(BatchRepository::class),
        $container->get(ConsignmentRepository::class),
        $container->get(DataTransferringService::class)
    );
});

// Controllers
$container->set(ConsignmentController::class, static function() use ($container): ConsignmentController {
    return new ConsignmentController($container->get(ConsignmentService::class));
});
