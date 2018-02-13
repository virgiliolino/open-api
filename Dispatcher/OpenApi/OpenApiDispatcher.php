<?php
namespace Dispatcher\OpenApi;

use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;
           
class OpenApiDispatcher {
    public static function InjectRoutesFromConfig(
        \Slim\App $app, 
        $config, 
        CommandRegisterer $commandRegisterer = null
    ) {
        $paramsValidator = new ParamsValidator();
        $requestValidator = new RequestValidator();
	if ($commandRegisterer === null) {
	   $commandRegisterer = new DefaultCommandRegisterer();
	}
        foreach ($config['paths'] as $route => $path) {
            foreach ($path as $method => $data) {
                $parameters = isset($data['parameters']) ?
                    $data['parameters'] : [];
                $requestParams = new Elements($parameters);
                $app->map(
                    [$method], 
                    $route, 
                    $commandRegisterer->register(
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
