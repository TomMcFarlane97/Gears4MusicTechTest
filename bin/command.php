<?php

use App\Commands\EndBatchCommand;
use App\Commands\StartBatchCommand;
use App\Services\BatchService;
use DI\Container;
use Symfony\Component\Console\Application;

require dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$container = new Container();

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$app = new Application('Gear4musicTechTest', '1.0.0');

$app->add(
    new StartBatchCommand('batch:start', $container->get(BatchService::class))
);

$app->add(
    new EndBatchCommand('batch:end', $container->get(BatchService::class))
);

$app->run();
