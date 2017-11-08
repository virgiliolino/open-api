<?php
namespace Dispatcher\Swagger;

use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;
           
class SwaggerDispatcher {
    public static function InjectRoutesFromConfig(\Slim\App $app, $config) {
        $paramsValidator = new ParamsValidator();
        $requestValidator = new RequestValidator();
        foreach ($config['paths'] as $route => $path) {
            foreach ($path as $method => $data) {
                $parameters = isset($data['parameters']) ?
                    $data['parameters'] : [];
                $requestParams = new Elements($parameters);
                $app->map(
                    [$method], 
                    $route, 
                    CommandRegisterer::register(
                        $route, 
                        $method, 
                        $data['operationId'],
                        $requestParams, 
                        $paramsValidator, 
                        $requestValidator,
                        $app->getContainer()
                    )
                );
            }
        }
    }
    
}

class Elements implements ContainerInterface {
    private $elements;
    
    public function __construct(array $elements) {
        $this->elements = $elements;
    }
    public function get($id) {
        return $this->elements[$id];
    }

    public function has($id): bool {
        return isset($this->elements[$id]);
    }
}

class CommandRegisterer {
    public static function register(
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
                //bla
            }
            
            if (!$requestValidator->isValid($route, $method, $requestParams, $request)) {
                //log error
                //bla
            } 

            /* @var CommandHandler $handler */
            $handler = $container->get($operationId);
            $handler->execute($request, $response, $params);
        };
    }
}


class ParamsValidator {
    private function validateTypes(
        ContainerInterface $requestParams, 
        RequestInterface $request
    ) {
        return true;
    }
    
    public function isValid(
        ContainerInterface $requestParams, 
        RequestInterface $request
    ) {
        //validate types, maybe with filter_var
        if (!$this->validateTypes($requestParams, $request)) {
            return false;
        }
    }
}

class RequestValidator {
    public function isValid(
        $route, 
        $method, 
        ContainerInterface $requestParams, 
        RequestInterface $request
    ) {
        return true;
    }
}
