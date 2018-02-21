<?php
namespace Dispatcher\OpenApi\Validators;

use Dispatcher\OpenApi\Application\Bridge\ApplicationBridge;
use Dispatcher\OpenApi\Commandregisterer\DefaultCommandRegisterer;
use Dispatcher\OpenApi\Elements;
use Dispatcher\OpenApi\RoutesInjector\SlimRoutesInjector;
use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class NullParamsValidator implements ParamsValidator {
    private function validateTypes(
        ContainerInterface $requestParams,
        RequestInterface $request
    ) {
        return true;
    }

    public function isValid(
        ContainerInterface /*Elements*/ $requestParams,
        RequestInterface $request
    ): bool {
        //validate types, maybe with filter_var
        if (!$this->validateTypes($requestParams, $request)) {
            return false;
        }
        return true;
    }
}
