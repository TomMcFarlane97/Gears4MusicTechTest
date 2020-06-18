<?php

use App\Controllers\ConsignmentController;
use Slim\Routing\RouteCollectorProxy;

$app->group('/api/consignment', function (RouteCollectorProxy $route) {
    $route->get('', ConsignmentController::class . ':get');
    $route->post('', ConsignmentController::class . ':create');
    $route->put('', ConsignmentController::class . ':put');
    $route->delete('', ConsignmentController::class . ':delete');
});
