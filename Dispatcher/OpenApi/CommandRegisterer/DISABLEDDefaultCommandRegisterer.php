<?php
namespace Dispatcher\OpenApi\Commandregisterer;

use Dispatcher\OpenApi\Application\Bridge\ApplicationBridge;
use Dispatcher\OpenApi\CommandRegisterer;
use Dispatcher\OpenApi\Elements;
use Dispatcher\OpenApi\Validators\ParamsValidator;
use Dispatcher\OpenApi\Validators\RequestValidator;
use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class DISABLEDDefaultCommandRegisterer implements CommandRegisterer {
    /** @TODO: remove concrete Elements restore ContainerInterface */
    public function register(
        $route,
        $method,
        String $operationId,
        ContainerInterface /*Elements*/ $requestParams,
        ParamsValidator $paramsValidator,
        RequestValidator $requestValidator,
        ApplicationBridge $application
    ) {
        exit("HEA");
        return $operationId;
        return function (
            \Psr\Http\Message\RequestInterface $request/*,
            \Psr\Http\Message\ResponseInterface $response,
            \Illuminate\Http\Request $request*/
        )  use (
            $route, 
            $method, 
            $operationId,
            $requestParams, 
            $paramsValidator, 
            $requestValidator,
            $application

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

            return $application->execute($operationId, $request);
        };
    }
}