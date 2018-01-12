<?php
namespace Dispatcher\Swagger;

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
        ContainerInterface $container
        ); 
}
