<?php

use App\Controllers\ConsignmentController;

$app->get('/', ConsignmentController::class . ':create');
