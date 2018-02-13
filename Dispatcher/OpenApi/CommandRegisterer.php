<?php
namespace Dispatcher\OpenApi;

use \Psr\Container\ContainerInterface;

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
