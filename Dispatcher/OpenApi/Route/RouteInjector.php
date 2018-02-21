<?php
namespace Dispatcher\OpenApi\Route;

use Bridge\Application\ApplicationBridge;
use Dispatcher\OpenApi\CommandRegisterer;
use Dispatcher\OpenApi\Validators\NullParamsValidator;
use Dispatcher\OpenApi\Validators\NullRequestValidator;
use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

interface RouteInjector {
    public function inject(
        ApplicationBridge $app,
        $config,
        CommandRegisterer  $commandRegisterer
    );
}
