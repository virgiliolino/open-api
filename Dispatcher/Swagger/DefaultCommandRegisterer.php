<?php
namespace Dispatcher\Swagger;

use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class DefaultCommandRegisterer implements CommandRegisterer {
    public function register(
        $route, 
        $method,
        String $operationId,
        ContainerInterface $requestParams, 
        ParamsValidator $paramsValidator, 
        RequestValidator $requestValidator,
        ContainerInterface $container
    ) {
        return function (RequestInterface $request, ResponseInterface $response, $params)  use (
            $route, 
            $method, 
            $operationId,
            $requestParams, 
            $paramsValidator, 
            $requestValidator,
            $container
        ) {
            if (!$paramsValidator->isValid($requestParams, $request)) {
                //log error
                //the real power in our ApiUpFront design, is that
		//by using the OpenAPI specification we can define the expected items
		//in input and output, and validate automatically that it conforms to the
		//specifications
		//if you are reading this, you could help me on implementing it
		//contact me, I'll give you hints
            }
            
            if (!$requestValidator->isValid($route, $method, $requestParams, $request)) {
                //same as for paramsValidator
            } 

            /* @var CommandHandler $handler */
            $handler = $container->get($operationId);
            return $handler->execute($request, $response, $params);
        };
    }
}