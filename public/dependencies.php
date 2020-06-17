<?php

use App\Controllers\ConsignmentController;
use App\Repositories\ConsignmentRepository;
use App\Services\ConsignmentService;

// Repositories
$container->set(ConsignmentRepository::class, static function(): ConsignmentRepository {
    return new ConsignmentRepository();
});

// Services
$container->set(ConsignmentService::class, static function() use ($container): ConsignmentService {
    return new ConsignmentService($container->get(ConsignmentRepository::class));
});


// Controllers
$container->set(ConsignmentController::class, static function() use ($container): ConsignmentController {
    return new ConsignmentController($container->get(ConsignmentService::class));
});
