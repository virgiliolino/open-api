<?php
namespace Dispatcher\OpenApi;

use Dispatcher\OpenApi\Application\Bridge\ApplicationBridge;
use Dispatcher\OpenApi\Validators\ParamsValidator;
use Dispatcher\OpenApi\Validators\RequestValidator;
use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

interface CommandRegisterer {
   public function register(
        $route,
        $method,
        String $operationId,
        ContainerInterface $requestParams,
        ParamsValidator $paramsValidator,
        RequestValidator $requestValidator,
        ApplicationBridge $application
    );
}
